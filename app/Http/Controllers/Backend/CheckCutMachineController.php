<?php

namespace App\Http\Controllers\Backend;

use App\Exports\CheckCutMachineExport;
use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Imports\CheckCutMachineImport;
use App\Models\Employee;
use App\Models\EmployeeDepartment;
use App\Models\Required;
use App\Models\SignatureSubmission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Maatwebsite\Excel\Facades\Excel;

class CheckCutMachineController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('checkCutMachine.create')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $machineLists = ArrayHelper::machineList();
        $requireds['keyword'] = $request->input('keyword', null);
        $requireds['per_page'] = $request->input('per_page', Cookie::get('per_page'));
        $requireds['advance'] = 0;
        $requireds['lists'] = Required::whereIn('from_type', [2, 3])->where(function ($query) use ($request) {
            $employeeId = Auth::user()->employee_id;
            $employeeDepartment = EmployeeDepartment::where('employee_id', $employeeId)->first();
            $employeePosition = isset($employeeDepartment) ? $employeeDepartment->positions : null;
            if (isset($request->keyword) && $request->keyword != null) {
                $query->filter($request);
            }
            if (isset($employeeId) && $employeeId != null) {
                if ($employeePosition != 4 && $employeePosition != 5) {
                    $query->where('created_by', $employeeId);
                }
            }
            if (isset($employeeDepartment->department_id) && $employeeDepartment->department_id != null) {
                $query->where('required_department_id', $employeeDepartment->department_id);
            }
            if (isset($request->from_date) && isset($request->to_date)) {
                $from_date = Carbon::parse($request->from_date)->format('Y-m-d');
                $to_date   = Carbon::parse($request->to_date)->format('Y-m-d');
                $query->whereDate('created_at', '>=', $from_date);
                $query->whereDate('created_at', '<=', $to_date);
            }
            if (isset($request->machine_name) && $request->machine_name != null) {
                // $query->where('machine_name', $request->machine_name);
                $query->whereRaw('JSON_EXTRACT(content_form, "$.name_machine") = ?', [$request->machine_name]);
            }
        })->orderBy('updated_at', 'desc')->paginate($requireds['per_page']);
        if (count($request->except('keyword')) > 0) {
            // Tìm kiếm nâng cao
            $requireds['advance'] = 1;
            $requireds['filter'] = $request->all();
        }
        return view('backend.pages.checkCutMachine.index', $requireds, compact('machineLists'));
    }

    public function create(Request $request)
    {
        $data['filter'] = $request->all();
        $data['get_machineName'] = $request->selecMachine;

        $data['repairMachines'] = Required::all();
        $machineLists = ArrayHelper::machineList();
        $key = array_search($request->selecMachine, array_column($machineLists, 'name'));
        $formTypeJobs = ArrayHelper::formTypeJobs()[$machineLists[$key]['type']]['data_table']['check_list'];
        $employee_id = Auth::user()->employee_id;
        $employee = Employee::where('id', $employee_id)->first();
        if (is_null($employee)) {
            session()->flash('error', "Bạn không có quyền vào mục này");
            return redirect()->route('admin.checkCutMachine.index');
        }
        $employee_department = EmployeeDepartment::where('employee_id', $employee->id)->first();
        // dd($employee_department);
        $formTypeJobsDepartment = ArrayHelper::formTypeJobs()[$machineLists[$key]['type']]['from_dept'];
        // dd($formTypeJobsDepartment[0] . '---' . $employee_department->department_id);
        if ($formTypeJobsDepartment[0] !== $employee_department->department_id) {
            session()->flash('error', "Bạn không có quyền vào mục này");
            return redirect()->route('admin.checkCutMachine.index');
        }
        return view('backend.pages.checkCutMachine.create', compact('formTypeJobs', 'machineLists', 'employee', 'employee_department'), $data);
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
        $employee_id = Auth::user()->employee_id;
        if (!isset($employee_id)) {
            return back()->with('error', 'Bạn không có quyền duyệt hoặc bỏ duyệt');
        }
        // dd($employee_id);
        $method = $request->input('method', '');
        // dd($method);
        if ($method == 'per_page') {
            $this->per_page($request);
            return back();
        } else if ($method == 'active_check') {
            if (isset($request->ids)) {
                // dd($request->ids);
                foreach ($request->ids as $key => $value) {
                    $signature_submissions = SignatureSubmission::where('required_id', $value)->where('status', 0)->first();
                    // dd($signature_submissions);
                    if (is_null($signature_submissions || !$signature_submissions)) {
                        return back()->with('error', 'Yêu cầu này đã được duyệt hoặc bạn không có quyền duyệt');
                    }
                    if (!in_array($employee_id, json_decode($signature_submissions->approve_id))) {
                        return back()->with('error', 'Yêu cầu này đã được duyệt hoặc bạn không có quyền duyệt');
                    }
                    $signature_submissions->status = 1;
                    $signature_submissions->signature_id = $employee_id;
                    $signature_submissions->save();
                }
            } else {
                return back()->with('error', 'Bạn phải chọn yêu cầu trước khi duyệt.');
            }
            return back()->with('success', 'thành công!');
        } else if ($method == 'inactive_check') {
            if (isset($request->ids)) {
                foreach ($request->ids as $key => $value) {
                    $signature_submissions = SignatureSubmission::where('required_id', $value)->where('status', 1)->first();
                    if (is_null($signature_submissions) || !$signature_submissions) {
                        return back()->with('error', 'Yêu cầu này chưa được duyệt.');
                    }
                    if (!$signature_submissions && !in_array($employee_id, json_decode($signature_submissions->approve_id))) {
                        return back()->with('error', 'Bạn không có quyền bỏ duyệt yêu cầu này!');
                    }
                    $signature_submissions->status = 0;
                    $signature_submissions->signature_id = 0;
                    $signature_submissions->save();
                }
            } else {
                return back()->with('error', 'Bạn phải chọn yêu cầu trước khi bỏ duyệt.');
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
    public function destroyTrash($id)
    {
        $required = Required::find($id);
        if (is_null($required)) {
            session()->flash('error', "Nội dung đã được xóa hoặc không tồn tại !");
            return redirect()->route('admin.required.index');
        }
        $required->deleted_at = Carbon::now();
        $required->deleted_by = Auth::id();
        $required->status = 0;
        $required->save();
        $required->delete();
        session()->flash('success', 'Đã xóa bản ghi thành công !!');
        return redirect()->route('admin.checkCutMachine.index');
    }
}
