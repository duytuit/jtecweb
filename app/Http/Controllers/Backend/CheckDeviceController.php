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

use function PHPSTORM_META\type;

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
        $data['keyword'] = $request->input('keyword', null);
        $data['per_page'] = $request->input('per_page', Cookie::get('per_page'));
        $data['advance'] = 0;
        $getDataRequired = Required::orderBy('created_at', 'desc')->where('from_type', 3)->where(function ($query) use ($request) {
            if (isset($request->keyword) && $request->keyword != null) {
                $query->filter($request);
            }
        })->first();
        $data['lists'] = json_decode($getDataRequired->content_form, true);
        return view('backend.pages.checkdevices.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // if (is_null($this->user) || !$this->user->can('employee.create')) {
        //     return abort(403, 'You are not allowed to access this page !');
        // }
        // dd($request->all());
        $employee_id = Auth::user()->employee_id;
        // $requiredType = $request->requiredType;
        $requiredType = 3;
        $checkDeviceData = new CheckDevice();
        $data['getWifiSSID'] = $checkDeviceData->getWifiSSID();
        $data['getComputerName'] = $checkDeviceData->getComputerName();
        $data['getProcessorInfo'] = $checkDeviceData->getProcessorInfo();
        $data['getOSInfo'] = $checkDeviceData->getOSInfo();
        $required = Required::orderBy('created_at', 'desc')->where('from_type', $requiredType)->first();
        $formTypeJobs = ArrayHelper::formTypeJobs()[$requiredType];
        if (!$required || is_null($required)) {
            $requiredData = $formTypeJobs['data_table'];
        } else {
            $requiredData = json_decode($required->content_form, true);
        }
        // dd($requiredData);
        $data['requiredNews'] =  $requiredData;
        $filteredPositions = array_filter($requiredData, function ($item) {
            return !empty($item['name']);
        });
        // $requiredData = $formTypeJobs['data_table'];
        $filteredPositionsByName = array_filter($requiredData, function ($item) use ($data) {
            return $item['name'] == $data['getComputerName'];
        });
        $positionsByName = array_column($filteredPositionsByName, 'position');
        $positions = array_column($filteredPositions, 'position');
        return view('backend.pages.checkdevices.create', $data, compact('filteredPositions', 'positionsByName', 'positions'));
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
        $formTypeJobs = ArrayHelper::formTypeJobs()[$requiredType];
        // $formData = $formTypeJobs['data_table'];
        $required = Required::orderBy('created_at', 'desc')->where('from_type', $requiredType)->first();
        if (is_null($required) || $required == '') {
            $requiredData = $formTypeJobs['data_table'];
            $dataTables = $requiredData;
        } else {
            $requiredData = $required->content_form;
            $dataTables = json_decode($requiredData, true);
        }

        if (is_null($departmentFromId) || $departmentFromId == '') {
            session()->flash('error', "Tài khoản của bạn không thể thực hiện tác vụ này");
            return redirect()->route('admin.checkdevices.create');
        }
        if (is_null($request->devicesInput) || $request->devicesInput == '') {
            session()->flash('error', "Bạn chưa chọn vị trí");
            return redirect()->route('admin.checkdevices.create');
        }

        $position = $request->devices_position;
        $deviceName = $request->devices_name;
        $deviceIP = $request->devices_ip;
        $dataTablesChanged = false;

        // Tìm và xóa thiết bị khỏi vị trí cũ
        foreach ($dataTables as $key => $dataTable) {
            if ($dataTable['name'] == $deviceName) {
                $dataTables[$key]['name'] = '';
                $dataTables[$key]['ip'] = '';
                $dataTablesChanged = true;
            }
        }

        // Tìm và cập nhật thiết bị vào vị trí mới
        foreach ($dataTables as $key => $dataTable) {
            if ($dataTable['position'] == $position && $dataTable['name'] == '') {
                $dataTables[$key]['name'] = $deviceName;
                $dataTables[$key]['ip'] = $deviceIP;
                $dataTablesChanged = true;
                break;
            }
        }

        // Chỉ lưu nếu có thay đổi trong dataTables
        if ($dataTablesChanged) {
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
                    'usage_status' => 1,
                    'content_form' => $json_data,
                    'status' => $status,
                    'from_type' => $requiredType,
                    'content' => $position,
                ]);

                DB::commit();
                session()->flash('success', 'Thêm mới thành công');
                return redirect()->route('admin.checkdevices.index');
            } catch (\Exception $e) {
                DB::rollBack();
                return $this->error(['error', $e->getMessage()]);
            }
        } else {
            session()->flash('info', 'Không có thay đổi nào được lưu.');
            return redirect()->route('admin.checkdevices.index');
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
