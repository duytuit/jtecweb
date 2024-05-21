<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ArrayHelper;
use App\Helpers\RedisHelper;
use App\Http\Controllers\Controller;
use App\Models\Accessory;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeDepartment;
use App\Models\Required;
use App\Models\SignatureSubmission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

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
    public function index(Request $request)
    {
        // $machineLists = ArrayHelper::machineList();
        $requireds['keyword'] = $request->input('keyword', null);
        $requireds['per_page'] = $request->input('per_page', Cookie::get('per_page'));
        $requireds['advance'] = 0;
        $requireds['lists'] = Required::where('from_type', 0)->where(function ($query) use ($request) {
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
                $to_date = Carbon::parse($request->to_date)->format('Y-m-d');
                $query->whereDate('created_at', '>=', $from_date);
                $query->whereDate('created_at', '<=', $to_date);
            }
            if (isset($request->machine_name) && $request->machine_name != null) {
                // $query->where('machine_name', $request->machine_name);
                $query->whereRaw('JSON_EXTRACT(content_form, "$.name_machine") = ?', [$request->machine_name]);
            }
        })->orderBy('updated_at', 'desc')->paginate($requireds['per_page']);
        // dd($requireds['lists']);
        if (count($request->except('keyword')) > 0) {
            // Tìm kiếm nâng cao
            $requireds['advance'] = 1;
            $requireds['filter'] = $request->all();
        }
        return view('backend.pages.requireds.index', $requireds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('required.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $requiredType = 0;
        $formTypeJobs = ArrayHelper::formTypeJobs()[$requiredType];
        $formTypeJobsDepartmentIds = $formTypeJobs['to_dept'];
        // dd($formTypeJobs);
        $positionTitles = ArrayHelper::positionTitle();
        $employee_id = Auth::user()->employee_id;
        $employee = Employee::where('id', $employee_id)->first();
        $employeeDepartment['employeeDepartmentAlls'] = EmployeeDepartment::all();
        $employeeDepartment['employeeDepartmentFromId'] = EmployeeDepartment::where('employee_id', $employee->id)->first();
        $departmentAlls = Department::all();
        $departmentFromId = Department::where('id', $employeeDepartment['employeeDepartmentFromId']->department_id)->first();
        // dd($departmentFromId->id);
        // if ($departmentFromId->id !== $formTypeJobs['from_dept']) {
        //     session()->flash('error', "Bạn không có quyền vào mục này");
        //     return redirect()->route('admin.index');
        // }
        return view('backend.pages.requireds.create', $employeeDepartment, compact('employee', 'formTypeJobs', 'formTypeJobsDepartmentIds', 'positionTitles', 'departmentAlls', 'departmentFromId', 'requiredType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $employee_id = Auth::user()->employee_id;
        $requireCode = 'R_' . now()->format('Ymdhis');
        $departmentFromId = EmployeeDepartment::where('employee_id', $employee_id)->first();
        // dd($departmentFromId->department_id);
        $requiredType = $request->requiredType;
        $formTypeJobs = ArrayHelper::formTypeJobs()[$requiredType];
        $dataTablesIds = $formTypeJobs['confirm_by_from_dept'];

        //tạo dữ liệu yêu cầu trong bảng required
        // dd($request->quantityType);
        try {
            DB::beginTransaction();
            $required = Required::create([
                'required_department_id' => $departmentFromId->department_id,
                'code_required' => $requireCode,
                'code' => $request->code,
                'quantity' => $request->quantity,
                'created_by' => Auth::user()->employee_id,
                'receiving_department_ids' => json_encode($formTypeJobs['to_dept']),
                'usage_status' => $request->quantityType,

            ]);

            //bộ phận yêu cầu
            // dd($formTypeJobs['confirm_from_dept']);
            if ($formTypeJobs['confirm_from_dept'] == 1 || $formTypeJobs['confirm_to_dept'] == 1) {
                $status = 1;
            }

            foreach ($dataTablesIds as $dataTablesId) {
                $emp_dept = EmployeeDepartment::where('department_id', $departmentFromId->department_id)->where('positions', $dataTablesId)->pluck('employee_id')->toArray();
                $emp_dept_lead = EmployeeDepartment::where('department_id', $departmentFromId->department_id)->where('positions', $dataTablesId)->first();
                $emp_dept_lead_id = $emp_dept_lead->employee_id;

                if (count($emp_dept) == 0) {
                    DB::rollBack();
                    return redirect()->back()->withInput();
                }
                $signature = SignatureSubmission::create([
                    'required_id' => $required->id,
                    'department_id' => $departmentFromId->department_id,
                    // 'content',
                    'positions' => $dataTablesId,
                    'approve_id' => json_encode($emp_dept),
                    'status' => $status,
                    'signature_id' => $emp_dept_lead_id,

                ]);
            }

            //bộ phận tiếp nhận
            $formTypeJobToDepts = ($formTypeJobs['to_dept']);
            // dd($formTypeJobToDepts);
            foreach ($formTypeJobToDepts as $key => $formTypeJobToDept) {
                // dd($formTypeJobToDept);
                foreach ($dataTablesIds as $dataTablesId) {
                    $emp_dept2 = EmployeeDepartment::where('department_id', $formTypeJobToDept)->where('positions', $dataTablesId)->pluck('employee_id')->toArray();
                    $emp_dept_lead = EmployeeDepartment::where('department_id', $formTypeJobToDept)->where('positions', 5)->first();
                    $emp_dept_lead_id = $emp_dept_lead->employee_id;
                    if (count($emp_dept2) == 0) {
                        DB::rollBack();
                        return redirect()->back()->withInput();
                    }
                    $signature = SignatureSubmission::create([
                        'required_id' => $required->id,
                        'department_id' => $formTypeJobToDept,
                        // 'content',
                        'positions' => $dataTablesId,
                        'approve_id' => json_encode($emp_dept2),
                        'status' => $status,
                        'signature_id' => $emp_dept_lead_id,
                    ]);
                }
            }
            DB::commit();
            session()->flash('success', 'Thêm mới thành công');
            return redirect()->route('admin.requireds.index');
        } catch (\Exception $e) {
            return $this->error(['error', $e->getMessage()]);
            DB::rollBack();
            return back();
        }
    }
    public function complete($id)
    {
        $requireds = Required::find($id);
        $employee_id = Auth::user()->employee_id;
        if (($requireds->status == 1)) {
            session()->flash('error', "Yêu cầu đã được thực hiện hoặc không tồn tại !");
            return redirect()->route('admin.requireds.index');
        }

        // if (is_null(Auth::user()) || !Auth::user()->can('admin.requireds.create')) {
        //     $message = 'You are not allowed to access this page!';
        //     return view('errors.403', compact('message'));
        // }

        if (is_null($requireds)) {
            session()->flash('error', "Yêu cầu đã được thực hiện hoặc không tồn tại !");
            return redirect()->route('admin.requireds.index');
        }

        $requireds->status = 1;
        $requireds->completed_by = $employee_id;
        $requireds->date_completed = Carbon::now();
        RedisHelper::queueSet('inventory_accessory', $requireds->accessory);
        $requireds->save();
        session()->flash('success', 'Đã thực hiện thành công !!');
        return redirect()->route('admin.requireds.index');
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
                    if (is_null($signature_submissions) || !$signature_submissions) {
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
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('required.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $required = Required::find($id);
        $username = Auth::user()->username;
        $employee = Employee::where('code', $username)->firstOrFail();
        $department = Department::where('id', $employee->process_id)->firstOrFail();
        try {
            $required->required_department_id = $department->id;
            $required->code_required = $employee->code;
            $required->save();
            session()->flash('success', "successfully.");
            return redirect()->route('admin.requireds.index');
        } catch (\Exception $e) {
            session()->flash('error', "Failed to update: " . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function requireCheckListMachineCut(Request $request)
    {
        // dd($request->all());
        $machineLists = ArrayHelper::machineList();
        // dd($machineLists);
        $key = array_search($request->machineName, array_column($machineLists, 'name'));
        // dd($request->machineName);
        if (is_null($request->machineName) || $request->machineName == '') {
            session()->flash('error', "Bạn phải chọn máy kiểm tra trước khi thực hiện");
            return redirect()->route('admin.checkCutMachine.create');
        }
        // dd($machineLists[$key]['type']);
        // dd($key);
        $dataTables = ArrayHelper::formTypeJobs()[$machineLists[$key]['type']]['data_table'];
        $dataTablesIds = ArrayHelper::formTypeJobs()[$machineLists[$key]['type']]['confirm_by_from_dept'];
        $dataTablesType = ArrayHelper::formTypeJobs()[$machineLists[$key]['type']];
        // dd($dataTablesType);
        $dataTables['name_machine'] = $request->machineName;
        $answers = $request->answer;
        $status = 1;
        $departmentId = $dataTablesType['from_dept'];
        // dd($departmentId);
        foreach ($answers as $key => $value) {
            if ($value == 0) {
                $status = 0;
            }
            if (!is_null($value) && $value !== '') {
                $dataTables['check_list'][$key]['answer'] = $value;
            } else {
                session()->flash('error', "Bạn phải kiểm tra hết tất cả nội dụng trước khi lưu");
            }
        }
        $json_data = json_encode($dataTables, JSON_UNESCAPED_UNICODE);
        try {
            DB::beginTransaction();
            $requireCode = 'R_' . now()->format('Ymdhis');
            $required = Required::create([
                'code_required' => $requireCode,
                'created_by' => Auth::user()->employee_id,
                'content_form' => $json_data,
                'required_department_id' => $request->departmentId,
                'code' => '',
                'content' => $request->repair_history,
                'from_type' => $dataTablesType['id'],
                'status' => $status,
            ]);

            //lưu dữ liệu vào signature_submissions table database
            foreach ($dataTablesIds as $dataTablesId) {
                $emp_dept = EmployeeDepartment::whereIn('department_id', $departmentId)->where('positions', $dataTablesId)->pluck('employee_id')->toArray();
                if (count($emp_dept) == 0) {
                    DB::rollBack();
                    return redirect()->back()->withInput();
                }
                $signature = SignatureSubmission::create([
                    'required_id' => $required->id,
                    'department_id' => $request->departmentId,
                    // 'content',
                    'positions' => $dataTablesId,
                    'approve_id' => json_encode($emp_dept),
                    // 'status',
                ]);
            }
            DB::commit();
            session()->flash('success', "successfully.");
            return redirect()->route('admin.checkCutMachine.index');
        } catch (\Exception $e) {
            session()->flash('error', "Failed to update: " . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withInput();
        }
    }
    // public function showCheckCutMachine(Request $request)
    // {
    //     $dataTables = ArrayHelper::formTypeJobs()[1]['data_table'];
    //     $dataTablesType = ArrayHelper::formTypeJobs()[1];
    //     $dataTables['name_machine'] = $request->selecMachine;
    //     $answers = $request->answer;
    //     foreach ($answers as $key => $value) {
    //         if (!is_null($value) && $value !== '') {
    //             $dataTables['check_list'][$key]['answer'] = $value;
    //         } else {
    //             session()->flash('error', "Bạn phải kiểm tra hết tất cả nội dụng trước khi lưu");
    //         }
    //     }
    //     $json_data = json_encode($dataTables, JSON_UNESCAPED_UNICODE);
    //     try {
    //         $requireCode = 'R_' . now()->format('Ymdhis');
    //         $required = Required::create([
    //             'code_required' => $requireCode,
    //             'created_by' => Auth::user()->employee_id,
    //             'content_form' => $json_data,
    //             'required_department_id' => $request->selecDepartment,
    //             'code' => '',
    //             'content' => $request->repair_history,
    //             'from_type' => $dataTablesType['id'],
    //         ]);

    //         session()->flash('success', "successfully.");
    //         return redirect()->route('admin.checkCutMachine.index');
    //     } catch (\Exception $e) {
    //         session()->flash('error', "Failed to update: " . $e->getMessage());
    //         return redirect()->back()->withInput();
    //     }
    // }
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
        // $data = Accessory::where('code', $accessorysCode)->first();
        $data = Accessory::where('code', 'like', '%' . $request->search . '%')->first();
        return response()->json($data);
    }
    public function destroyCheckCutMachine(Request $request)
    {
        $id = $request->input('id');
        if (is_null($this->user) || !$this->user->can('required.delete')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $requireds = Required::find($id);
        if (is_null($requireds)) {
            session()->flash('error', "Nội dung đã được xóa hoặc không tồn tại !");
            return redirect()->route('admin.checkCutMachine.index');
        }
        $requireds->deleted_at = Carbon::now();
        $requireds->deleted_by = Auth::id();
        $requireds->save();

        session()->flash('success', 'Đã xóa bản ghi thành công !!');
        return redirect()->route('admin.checkCutMachine.edit');
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
        return redirect()->route('admin.requireds.index');
    }
}
