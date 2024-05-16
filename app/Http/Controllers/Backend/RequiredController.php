<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Models\Accessory;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeDepartment;
use App\Models\Required;
use App\Models\SignatureSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


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
    public function create(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('required.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $formTypeJobs = ArrayHelper::formTypeJobs();
        $positionTitles = ArrayHelper::positionTitle();
        $required = new Required();
        // $username = Auth::user()->username;
        // $employee['employeeCode'] = Employee::where('code', $username)->firstOrFail();
        // $employees = Employee::where('code',$employeeDepartment->employee_id,)->firstOrFail();
        // $employeeDepartment = EmployeeDepartment::where('employee_id', $employee->id)->firstOrFail();
        // $department = Department::where('id', $employee->process_id)->firstOrFail();
        // $employeeDepartments = EmployeeDepartment::where('department_id', $department->id,)->firstOrFail();

        $employees = Employee::all();
        $employeeDepartments = EmployeeDepartment::all();
        $departments = Department::all();
        return view('backend.pages.requireds.create', compact('employees', 'departments', 'formTypeJobs', 'positionTitles', 'employeeDepartments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'code_required' => 'required',
        //     // 'name' => 'required',
        // ]);
        $username = Auth::user()->username;
        $employee = Employee::where('code', $username)->firstOrFail();
        $department = Department::where('id', $employee->process_id)->firstOrFail();

        try {
            DB::beginTransaction();
            $required = Required::create([
                'required_department_id' => $department->id,
                'code_required' => $employee->code,
                'code' => $request->code,
                'quantity' => $request->quantity,
                'created_by' => Auth::user()->id,
            ]);
            DB::commit();
            session()->flash('success', 'Thêm mới thành công');
            return redirect()->route('admin.requireds.index');
        } catch (\Exception $e) {
            return $this->error(['error', $e->getMessage()]);
            DB::rollBack();
            return back();
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
        $dataTables = ArrayHelper::formTypeJobs()[1]['data_table'];
        $dataTablesIds = ArrayHelper::formTypeJobs()[1]['confirm_by_from_dept'];
        $dataTablesType = ArrayHelper::formTypeJobs()[1];
        $dataTables['name_machine'] = $request->selecMachine;
        $answers = $request->answer;
        $status = 1;
        $departmentId = $dataTablesType['from_dept'];
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
                'code_required' => Auth::user()->username,
                'created_by' => Auth::user()->id,
                'content_form' => $json_data,
                'required_department_id' => $request->departmentId,
                'code' => $requireCode,
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
                    // 'sign_instead',
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
    public function showCheckCutMachine(Request $request)
    {
        $dataTables = ArrayHelper::formTypeJobs()[1]['data_table'];
        $dataTablesType = ArrayHelper::formTypeJobs()[1];
        $dataTables['name_machine'] = $request->selecMachine;
        $answers = $request->answer;
        foreach ($answers as $key => $value) {
            if (!is_null($value) && $value !== '') {
                $dataTables['check_list'][$key]['answer'] = $value;
            } else {
                session()->flash('error', "Bạn phải kiểm tra hết tất cả nội dụng trước khi lưu");
            }
        }
        $json_data = json_encode($dataTables, JSON_UNESCAPED_UNICODE);
        try {
            $requireCode = 'R_' . now()->format('Ymdhis');
            $required = Required::create([
                'code_required' => Auth::user()->username,
                'created_by' => Auth::user()->id,
                'content_form' => $json_data,
                'required_department_id' => $request->selecDepartment,
                'code' => $requireCode,
                'content' => $request->repair_history,
                'from_type' => $dataTablesType['id'],
            ]);

            session()->flash('success', "successfully.");
            return redirect()->route('admin.checkCutMachine.index');
        } catch (\Exception $e) {
            session()->flash('error', "Failed to update: " . $e->getMessage());
            return redirect()->back()->withInput();
        }
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
        $data = Accessory::where('code', $accessorysCode)->first();
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
}
