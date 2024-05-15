<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Required;
use App\Models\SignatureSubmission;
use App\Exports\CheckCutMachineExport;
use App\Imports\CheckCutMachineImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cookie;

use App\Models\Employee;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CheckCutMachineController extends Controller
{
    public $user;

    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         $this->user = Auth::user();
    //         return $next($request);
    //     });
    // }

    public function index(Request $request)
    {
        $formTypeJobs = ArrayHelper::formTypeJobs()[1]['data_table']['check_list'];
        $machineLists = ArrayHelper::machineList();
        $username = Auth::user()->username;
        $employee = Employee::where('code', $username)->firstOrFail();
        $departmentId = $employee->process_id;
        $departments = Department::all();
        $requireds['keyword'] = $request->input('keyword', null);
        $requireds['per_page'] = $request->input('per_page', Cookie::get('per_page'));
        $requireds['advance'] = 0;
        $requireds['lists'] = Required::where(function ($query) use ($request) {
            if (isset($request->keyword) && $request->keyword != null) {
                $query->filter($request);
            }
        })->orderBy('updated_at', 'desc')->paginate($requireds['per_page']);
        // dd($requireds['lists']);
        if (count($request->except('keyword')) > 0) {
            // Tìm kiếm nâng cao
            $requireds['advance'] = 1;
            $requireds['filter'] = $request->all();
        }
        return view('backend.pages.checkCutMachine.index', compact('formTypeJobs', 'machineLists', 'departments', 'employee', 'departmentId'), $requireds);
    }
    public function create()
    {
        $formTypeJobs = ArrayHelper::formTypeJobs()[1]['data_table']['check_list'];
        $machineLists = ArrayHelper::machineList();
        $username = Auth::user()->username;
        $employee = Employee::where('code', $username)->firstOrFail();
        $departmentId = $employee->process_id;
        $departments = Department::all();
        return view('backend.pages.checkCutMachine.create', compact('formTypeJobs', 'machineLists', 'departments', 'employee', 'departmentId'));
    }
    public function importExcelData(Request $request)
    {
        $request->validate([
            'import_file' => [
                'required',
                'file',
            ],
        ]);
        Excel::import(new CheckCutMachineImport, $request->file('import_file'));
        session()->flash('success', 'Thêm mới thành công');
        return response()->json('uploaded successfully');
    }

    public function action(Request $request)
    {
        $userId = Auth::user()->id;
        $method = $request->input('method', '');
        if ($method == 'per_page') {
            $this->per_page($request);
            return back();
        } else if ($method == 'active') {
            if (isset($request->ids)) {
                foreach ($request->ids as $key => $value) {
                    $signature_submissions = SignatureSubmission::where('required_id', $value)->where('status', 0)->first();
                    if ($signature_submissions && !in_array($userId, json_decode($signature_submissions->approve_id))) {
                        return back()->with('error', 'Bạn không có quyền duyệt yêu cầu này!');
                    }
                    $signature_submissions->status = 1;
                    $signature_submissions->signature_id = $userId;
                    $signature_submissions->save();
                }
            }
            return back()->with('success', 'thành công!');
        } else if ($method == 'inactive') {
            if (isset($request->ids)) {
                foreach ($request->ids as $key => $value) {
                    $signature_submissions = SignatureSubmission::where('required_id', $value)->where('status', 0)->first();
                    if ($signature_submissions && !in_array($userId, json_decode($signature_submissions->approve_id))) {
                        return back()->with('error', 'Bạn không có quyền duyệt yêu cầu này!');
                    }
                    $signature_submissions->status = 0;
                    $signature_submissions->signature_id = 0;
                    $signature_submissions->save();
                }
            }
            return back()->with('success', 'thành công!');
        } else if ($method == 'delete') {
            if (isset($request->ids)) {
                foreach ($request->ids as $key => $value) {
                    $count_record = Required::find($value)->delete();
                }
            }
            return back()->with('success', 'đã xóa ' . count($request->ids) . ' bản ghi');
        } else {
            return back()->with('success', 'thành công!');
        }
    }

    public function exportExcel(Request $request)
    {
        $data = Required::where(function ($query) use ($request) {
            if (isset($request->keyword) && $request->keyword != null) {
                $query->filter($request);
            }
            if (isset($request->status) && $request->status != null) {
                $query->where('status', $request->status);
            }
        })->orderBy('code')->get();
        return (new CheckCutMachineExport($data))->download('Required-export.xlsx');
    }
}
