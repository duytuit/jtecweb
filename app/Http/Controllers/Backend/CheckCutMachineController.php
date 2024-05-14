<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Department;

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
    //index
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
}
