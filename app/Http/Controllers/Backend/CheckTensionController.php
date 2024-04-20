<?php

namespace App\Http\Controllers\Backend;

use App\Models\CheckTension;
// use App\Imports\CheckTensionImport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckTensionController extends Controller
{
    public $user;

    public function __construct()
    {
        // dd(1);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        // if (is_null($this->user) || !$this->user->can('backend.pages.checkTension.index')) {
        //     $message = 'Bạn cần đăng nhập trước khi làm việc';
        //     return view('errors.403', compact('message'));
        // }
        $checkTension = CheckTension::all();
        return view('backend.pages.checkTension.index', compact('checkTension'));
    }
    
    public function view()
    {
        $checkTension = CheckTension::all();
        return view('backend.pages.checkTension.view', compact('checkTension'));
    }

    // public function edit($id)
    // {
    //     $checkTension = CheckTension::find($id);
    //     return view('backend.pages.checkTension.index', compact('checkTension'));
    // }

    public function saveData(Request $request)
    {
        $checkTension = new CheckTension();
        $checkTension->target125 = '9';
        $checkTension->target2 = '15';
        $checkTension->target55 = '29';
        $checkTension->weight125 = $request->input('weight125');
        $checkTension->weight2 = $request->input('weight2');
        $checkTension->weight55 = $request->input('weight55');
        $checkTension->selectComputer = $request->input('selectComputer');
        if ($checkTension->weight125 >= $checkTension->target125 and $checkTension->weight2 >= $checkTension->target2 and $checkTension->weight55 >= $checkTension->target55) {
            $checkTension->checkresult = 'OK';
        } else {
            $checkTension->checkresult = 'NG';
        }
        $checkTension->save();
        
        return view('backend.pages.checkTension.complete', compact('checkTension'));
    }
    public function viewData()
    {
        $viewdata = CheckTension::all();
        return view('backend.pages.checkTension.view', compact('viewdata'));
    }

    public function exportExcel(Request $request)
    {
        $data = CheckTension::where( function($query) use($request){
            if (isset($request->keyword) && $request->keyword != null) {
                $query->filter($request);
            }
            if (isset($request->cycle_name) && $request->cycle_name != null) {
                $query->where('cycle_name', $request->cycle_name);
            }
            if(isset($request->status) && $request->status != null){
                $query->where('status', $request->status);
            }
            if (isset($request->from_date) && isset($request->to_date)) {
                $from_date = Carbon::parse($request->from_date)->format('Y-m-d');
                $to_date   = Carbon::parse($request->to_date)->format('Y-m-d');
                $query->whereDate('create_date', '>=', $from_date);
                $query->whereDate('create_date', '<=', $to_date);
            }
        })->orderBy('code')->orderBy('cycle_name')->orderBy('created_at')->get();
       return (new CheckTension($data))->download('tension.xlsx');
    }
}
