<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
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

    public function index()
    {
        $formTypeJobs = ArrayHelper::formTypeJobs()[1]['data_table']['check_list'];
        $machineLists = ArrayHelper::machineList();
        $username = Auth::user()->username;
        $employee = Employee::where('code', $username)->firstOrFail();
        $departmentId = $employee->process_id;
        $departments = Department::all();

        return view('backend.pages.checkCutMachine.index', compact('formTypeJobs', 'machineLists', 'departments', 'employee', 'departmentId'));
    }

    public function show()
    {
        $formTypeJobs = ArrayHelper::formTypeJobs()[1]['data_table']['check_list'];
        $machineLists = ArrayHelper::machineList();
        $username = Auth::user()->username;
        $employee = Employee::where('code', $username)->firstOrFail();
        $departmentId = $employee->process_id;
        $departments = Department::all();

        return view('backend.pages.checkCutMachine.show', compact('formTypeJobs', 'machineLists', 'departments', 'employee', 'departmentId'));
    }

}