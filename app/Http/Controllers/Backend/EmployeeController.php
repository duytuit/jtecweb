<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DepartmentImport;
use App\Exports\DepartmentExport;
use App\Models\Department;
use Illuminate\Support\Facades\DB;


class EmployeeController extends Controller
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
        if (is_null($this->user) || !$this->user->can('employee.view')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        // Phân trang
        $employees['per_page'] = $request->input('per_page', Cookie::get('per_page'));
        $employees['keyword'] = $request->input('keyword', null);
        $employees['advance'] = 0;
        if (count($request->except('keyword')) > 0) {
            // Tìm kiếm nâng cao
            $employees['advance'] = 1;
            $employees['filter'] = $request->all();
        }
        $employees['lists'] = Employee::where(function ($query) use ($request) {
            if (isset($request->keyword) && $request->keyword != null) {
                $query->filter($request);
            }
        })->paginate($employees['per_page']);
        return view('backend.pages.employees.index', $employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('employee.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $data['departments'] = Department::all();
        return view('backend.pages.employees.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $employees = Employee::create([
                'code' => $request->code,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'begin_date_company' => Carbon::parse($request->begin_date_company)->format('Y-m-d'),
                'status' => @$request->status ? 1 : 0,
                'created_by' => Auth::user()->id,
                'identity_card' => $request->identity_card,
                'birthday' => Carbon::parse($request->birthday)->format('Y-m-d'),
                'addresss' => $request->addresss,
                'process_id' => $request->process_id,
                'marital' => $request->marital,
                'worker' => $request->worker,
                'positions' => $request->positions,
                'end_date_company' => $request->end_date_company,
            ]);
            DB::commit();
            session()->flash('success', 'Thêm mới thành công');
            return redirect()->route('admin.employees.index');
        } catch (\Exception $e) {
            return $this->error(['error', $e->getMessage()]);
            DB::rollBack();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_null($this->user) || !$this->user->can('employees.view')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $employee = Employee::find($id);
        return view('backend.pages.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('employee.edit')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $employee = Employee::find($id);
        $data['departments'] = Department::all();
        // return view('backend.pages.employees.edit')->with('employee', $employee)->with('departments', $data);
        return view('backend.pages.employees.edit', compact('employee', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        if (empty($employee)) {
            session()->flash('error', "The page is not found.");
            return redirect()->route('admin.employees.index');
        }

        // Update employee
        try {
            $employee->first_name = $request->input('first_name');
            $employee->last_name = $request->input('last_name');
            $employee->code = $request->input('code');
            $employee->begin_date_company = $request->input('begin_date_company');
            $employee->status = $request->input('status');
            $employee->created_by = $request->input('created_by');
            $employee->identity_card = $request->input('identity_card');
            $employee->birthday = $request->input('birthday');
            $employee->addresss = $request->input('addresss');
            $employee->process_id = $request->input('process_id');
            $employee->marital = $request->input('marital');
            $employee->worker = $request->input('worker');
            $employee->positions = $request->input('positions');
            $employee->end_date_company = $request->input('end_date_company');
            $employee->save();

            session()->flash('success', "Employee updated successfully.");
            return redirect()->route('admin.employees.index');
        } catch (\Exception $e) {
            session()->flash('error', "Failed to update Employee: " . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
    public function destroyTrash($id)
    {
        $employee = Employee::find($id);
        if (is_null($employee)) {
            session()->flash('error', "Nội dung đã được xóa hoặc không tồn tại !");
            return redirect()->route('admin.employee.index');
        }
        $employee->deleted_at = Carbon::now();
        $employee->deleted_by = Auth::id();
        $employee->status = 0;
        $employee->save();
        $employee->delete();
        session()->flash('success', 'Đã xóa bản ghi thành công !!');
        return redirect()->route('admin.employees.index');
    }
}
