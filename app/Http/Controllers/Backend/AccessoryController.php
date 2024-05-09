<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Accessory;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AccessoryController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (is_null($this->user) || !$this->user->can('accessory.view')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        // Phân trang
        $data['per_page'] = $request->input('per_page', Cookie::get('per_page'));
        $data['keyword'] = $request->input('keyword', null);
        $data['advance'] = 0;
        if (count($request->except('keyword')) > 0) {
            // Tìm kiếm nâng cao
            $data['advance'] = 1;
            $data['filter'] = $request->all();
        }
        $data['lists'] = Accessory::where(function ($query) use ($request) {
            if (isset($request->keyword) && $request->keyword != null) {
                $query->filter($request);
            }
            if (isset($request->status) && $request->status != null) {
                $query->where('status', $request->status);
            }
            if (isset($request->from_date) && isset($request->to_date)) {
                $from_date = Carbon::parse($request->from_date)->format('Y-m-d');
                $to_date   = Carbon::parse($request->to_date)->format('Y-m-d');
                $query->whereDate('created_at', '>=', $from_date);
                $query->whereDate('created_at', '<=', $to_date);
            }
        })->orderBy('created_at')->paginate($data['per_page']);
        return view('backend.pages.accessorys.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function show(Accessory $accessory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('accessory.edit')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $accessory = Accessory::find($id);
        return view('backend.pages.accessorys.edit', compact('accessory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('accessory.edit')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $accessory = Accessory::find($id);
        if (is_null($accessory)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('admin.blogs.index');
        }
        try {
            $accessory->material_norms=$request->material_norms;
            if (!is_null($request->image)) {
                $accessory->image = UploadHelper::upload('image', $request->image, $accessory->code . '-' . time(), 'public/assets/images/accessory');
            }
            $accessory->save();
            session()->flash('success', 'Sửa thành công !!');
            return redirect()->route('admin.accessorys.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accessory $accessory)
    {
        //
    }
}
