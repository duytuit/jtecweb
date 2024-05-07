<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ArrayHelper;
use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use App\Imports\EmployeeImport;
use App\Exports\EmployeeExport;

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
            if (isset($request->worker) && $request->worker != null) {
                $query->where('worker', $request->worker);
            }
            if (isset($request->positions) && $request->positions != null) {
                $query->where('positions', $request->positions);
            }
            if (isset($request->from_date) && isset($request->to_date)) {
                $from_date = Carbon::parse($request->from_date)->format('Y-m-d');
                $to_date = Carbon::parse($request->to_date)->format('Y-m-d');
                $query->whereDate('begin_date_company', '>=', $from_date);
                $query->whereDate('begin_date_company', '<=', $to_date);
            }

        })->paginate($employees['per_page']);
        $workers = ArrayHelper::worker();
        $positions = ArrayHelper::positions();

        return view('backend.pages.employees.index', compact('workers', 'positions'), $employees);
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
        $roles = DB::table('roles')->get();
        $positions = ArrayHelper::positions();
        $maritals = ArrayHelper::marital();
        $workers = ArrayHelper::worker();
        $banksLists = ArrayHelper::banksList();
        return view('backend.pages.employees.create', compact('roles', 'positions', 'maritals', 'workers', 'banksLists'), $data);
    }
public function exportExcel(Request $request)
    {
        $data = Employee::where(function ($query) use ($request) {
            if (isset($request->keyword) && $request->keyword != null) {
                $query->filter($request);
            }
            if (isset($request->status) && $request->status != null) {
                $query->where('status', $request->status);
            }
        })->orderBy('code')->get();
        return (new EmployeeExport($data))->download('Employee-export.xlsx');
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

            $employee = new Employee(); // Tạo một đối tượng Employee mới
            $employee->code = $request->code;
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->begin_date_company = Carbon::parse($request->begin_date_company)->format('Y-m-d');
            $employee->status = @$request->status ? 1 : 0;
            $employee->created_by = Auth::user()->id;
            $employee->identity_card = $request->identity_card;
            $employee->birthday = Carbon::parse($request->birthday)->format('Y-m-d');
            $employee->addresss = $request->addresss;
            $employee->process_id = $request->process_id;
            $employee->marital = $request->marital;
            $employee->worker = $request->worker;
            $employee->positions = $request->positions;
            $employee->phone = $request->phone;
            $employee->email = $request->email;
            $employee->bank_number = $request->bank_number;
            $employee->bank_name = $request->bank_name;
            $employee->end_date_company = Carbon::parse($request->end_date_company)->format('Y-m-d');

            if (!is_null($request->avatar)) {
                $employee->avatar = UploadHelper::upload('avatar', $request->avatar, $request->last_name . '-' . time(), 'public/assets/images/avatar');
            }
            $employee->save();
            DB::commit();
            session()->flash('success', 'Thêm mới thành công');
            return redirect()->route('admin.employees.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage());
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
        $roles = DB::table('roles')->get();
        $positions = ArrayHelper::positions();
        $maritals = ArrayHelper::marital();
        $workers = ArrayHelper::worker();
        $banksLists = ArrayHelper::banksList();
        return view('backend.pages.employees.edit', compact('employee', 'roles', 'positions', 'maritals', 'workers', 'banksLists'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    // public function update(Request $request, $id, $isProfileUpdate = false)
    {
        $employee = Employee::find($id);
        $data['departments'] = Department::all();
        if (empty($employee)) {
            session()->flash('error', "The page is not found.");
            return redirect()->route('admin.employees.index');
        }
        // $admin = Admin::find($id);

        // if (is_null($admin)) {
        //     session()->flash('error', "The page is not found !");
        //     return redirect()->route('admin.admins.index');
        // }
        // Update employee
        try {
            $employee->code = $request->input('code');
            $employee->first_name = $request->input('first_name');
            $employee->last_name = $request->input('last_name');
            $employee->begin_date_company = Carbon::parse($request->input('begin_date_company'))->format('Y-m-d');
            $employee->status = $request->input('status');
            $employee->created_by = $request->input('created_by');
            $employee->identity_card = $request->input('identity_card');
            $employee->birthday = Carbon::parse($request->input('birthday'))->format('Y-m-d');
            $employee->addresss = $request->input('addresss');
            $employee->process_id = $request->input('process_id');
            $employee->marital = $request->input('marital');
            $employee->worker = $request->input('worker');
            $employee->positions = $request->input('positions');
            $employee->end_date_company = Carbon::parse($request->input('end_date_company'))->format('Y-m-d');
            $employee->avatar = $request->input('avatar');
            $employee->phone = $request->input('phone');
            $employee->email = $request->input('email');
            $employee->bank_number = $request->input('bank_number');
            $employee->bank_name = $request->input('bank_name');
            $employee->roles = $request->input('roles');

            if (!is_null($request->avatar)) {
                $employee->avatar = UploadHelper::upload('avatar', $request->avatar, $request->last_name . '-' . time(), 'public/assets/images/avatar');
            }
            // if (!$isProfileUpdate) {
            //     // Detach roles and Assign Roles
            //     $admin->roles()->detach();

            //     if (!is_null($request->roles)) {
            //         foreach ($request->roles as $role) {
            //             $admin->assignRole($role);
            //         }
            //     }
            // }
            $employee->save();
            // if ($isProfileUpdate)    return back();
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
