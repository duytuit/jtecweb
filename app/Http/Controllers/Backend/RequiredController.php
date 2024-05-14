<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Accessory;
use App\Models\Required;
use App\Models\Employee;
use App\Models\Department;
use App\Models\EmployeeDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\ArrayHelper;

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
        return view('backend.pages.requireds.create',  compact('employees', 'departments', 'formTypeJobs', 'positionTitles', 'employeeDepartments'));
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
        // if (is_null($this->user) || !$this->user->can('checkCutMachine.index')) {
        //     return abort(403, 'You are not allowed to access this page !');
        // }
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
            return redirect()->route('admin.requireds.show');
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
}
