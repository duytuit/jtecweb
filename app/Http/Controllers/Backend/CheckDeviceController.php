<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Models\CheckDevice;
use App\Models\EmployeeDepartment;
use App\Models\Required;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class CheckDeviceController extends Controller
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
        $requireds['keyword'] = $request->input('keyword', null);
        $requireds['per_page'] = $request->input('per_page', Cookie::get('per_page'));
        $requireds['advance'] = 0;
        $requireds['lists'] = Required::where('from_type', 3)->where(function ($query) use ($request) {
            if (isset($request->keyword) && $request->keyword != null) {
                $query->filter($request);
            }
        });
        return view('backend.pages.checkdevices.index', $requireds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (is_null($this->user) || !$this->user->can('employee.create')) {
        //     return abort(403, 'You are not allowed to access this page !');
        // }
        $employee_id = Auth::user()->employee_id;

        $checkDeviceData = new CheckDevice();
        $data['getWifiSSID'] = $checkDeviceData->getWifiSSID();
        $data['getComputerName'] = $checkDeviceData->getComputerName();
        $data['getProcessorInfo'] = $checkDeviceData->getProcessorInfo();
        $data['getOSInfo'] = $checkDeviceData->getOSInfo();

        return view('backend.pages.checkdevices.create', $data);
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
        $requiredType = $request->requiredType;
        // dd($requiredType);
        $formTypeJobs = ArrayHelper::formTypeJobs()[$requiredType];
        $dataTables = $formTypeJobs['data_table'];
        // dd($dataTables);
        if (is_null($request->devicesInput) || $request->devicesInput == '') {
            session()->flash('error', "Bạn chưa chọn vị trí");
            return redirect()->route('admin.checkdevices.create');
        }

        $dataTables['devices_name'] = $request->device_name;
        $dataTables['devices_os'] = $request->devices_os;
        $dataTables['devices_ip'] = $request->devices_ip;
        $json_data = json_encode($dataTables, JSON_UNESCAPED_UNICODE);
        $status = 1;
        if ($formTypeJobs['confirm_from_dept'] == 1 && $formTypeJobs['confirm_to_dept'] == 1) {
            $status = 1;
        } else {
            $status = 0;

        }
        try {
            DB::beginTransaction();
            $required = Required::create([
                'required_department_id' => $departmentFromId->department_id,
                'code_required' => $requireCode,
                'code' => '',
                'quantity' => '',
                'created_by' => Auth::user()->employee_id,
                // 'receiving_department_ids' => json_encode($formTypeJobs['to_dept']),
                'usage_status' => 1,
                'content_form' => $json_data,
                'status' => $status,
                'from_type' => $requiredType,
                'content' => $request->device_position,
            ]);

            DB::commit();
            session()->flash('success', 'Thêm mới thành công');
            return redirect()->route('admin.checkdevices.index');
        } catch (\Exception $e) {
            return $this->error(['error', $e->getMessage()]);
            DB::rollBack();
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CheckDevice  $checkDevice
     * @return \Illuminate\Http\Response
     */
    public function show(CheckDevice $checkDevice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CheckDevice  $checkDevice
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckDevice $checkDevice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CheckDevice  $checkDevice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckDevice $checkDevice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CheckDevice  $checkDevice
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckDevice $checkDevice)
    {
        //
    }
}
