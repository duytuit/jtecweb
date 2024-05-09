<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Accessory;
use App\Models\Required;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequiredController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('required.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        return view('backend.pages.requireds.create');
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
     * @param  \App\Models\Required  $required
     * @return \Illuminate\Http\Response
     */
    public function show(Required $required)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Required  $required
     * @return \Illuminate\Http\Response
     */
    public function edit(Required $required)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Required  $required
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Required $required)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Required  $required
     * @return \Illuminate\Http\Response
     */
    public function destroy(Required $required)
    {
        //
    }
    public function showDataAccessorys(Request $request)
    {
        $accessorysCode = $request->input('selectedValue');
        $accessorys = Accessory::where('code', $accessorysCode)->first();
        if (empty($accessorys)) {
            session()->flash('error', "The page is not found.");
            return redirect()->back();
        }
        try {
            $accessorys->material_norms = $request->input('material_norms');
            $accessorys->unit = $request->input('unit');
            $accessorys->save();
            session()->flash('success', " successfully.");
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('error', "Failed " . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
