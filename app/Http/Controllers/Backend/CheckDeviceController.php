<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\CheckDevice;
use App\Models\EmployeeDepartment;
use App\Models\Required;
use App\Models\SignatureSubmission;
use Carbon\Carbon;
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
        $data['keyword'] = $request->input('keyword', null);
        $data['per_page'] = $request->input('per_page', Cookie::get('per_page'));
        $data['advance'] = 0;
        $data['positionByDevices'] = ArrayHelper::PositionByDevices();
        $curentDate = $request->search_date ? $request->search_date : Carbon::now()->format('d-m-Y');
        $data['filter'] = $request->all();
        $data['filter']['search_date'] = $curentDate;
        $data['lists'] = Required::where('from_type',3)->whereDate('created_at',Carbon::parse($curentDate)->format('Y-m-d'))->orderBy('created_at', 'desc')->where(function ($query) use ($request) {
            if (isset($request->keyword) && $request->keyword != null) {
                $query->whereHas('employee',function($query) use($request){
                    $query->where('code',$request->keyword);
                });
            }
        })->paginate(5);
        return view('backend.pages.checkdevices.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $checkDeviceData = new CheckDevice();
        $data['per_page'] = $request->input('per_page', Cookie::get('per_page'));
        $data['getWifiSSID'] = $checkDeviceData->getWifiSSID();
        $data['getComputerName'] = $checkDeviceData->getComputerName();
        $data['getProcessorInfo'] = $checkDeviceData->getProcessorInfo();
        $data['getOSInfo'] = $checkDeviceData->getOSInfo();
        $user = Auth::user();
        $employee = @$user->employee;
        $data['user'] = $user;
        if($employee){
            $data['employeeDepartment']= EmployeeDepartment::where('employee_id', $employee->id)->first();
        }
        $data['requiredType']=3;
        $data['devicesList']  = Asset::where('status',1)->get();
        $data['PositionByDevices']  = ArrayHelper::PositionByDevices();
        $data['lists'] = Required::where('from_type',3)->where(function ($query) use ($request) {
            if (isset($request->keyword) && $request->keyword != null) {
                $query->filter($request);
            }
            if (isset($request->status) && $request->status != null) {
                $query->where('status', $request->status);
            }
        })->paginate(5);
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

        $user = Auth::user();
        $employee = @$user->employee;
        if(!$employee){
            session()->flash('warning', "Liên hệ admin để sử dụng tính năng");
            return redirect()->route('admin.checkdevices.create');
        }
        $requireCode = 'R_' . now()->format('Ymdhis');
        $employeeDepartment = EmployeeDepartment::where('employee_id', $employee->id)->first();
        $requiredType = $request->requiredType;
        $formTypeJobs = ArrayHelper::formTypeJobs()[$requiredType];
        $content_form = $formTypeJobs['data_table'];
        $list_device = ArrayHelper::devicesList();
        $device = array_filter($list_device, fn ($element) => $element['name'] == $request->device);
        $content_form['model']=current($device)['model'];
        $content_form['color']=current($device)['color'];
        $content_form['name']=current($device)['name'];
        $content_form['position']=$request->position;
        if (is_null($employeeDepartment) || $employeeDepartment == '') {
            session()->flash('warning', "Liên hệ admin để sử dụng tính năng");
            return redirect()->route('admin.checkdevices.create');
        }
        $status = 0;
        if ($formTypeJobs['confirm_from_dept'] == 1) {
            $status = 1;
        }
        try {
            DB::beginTransaction();

            if($request->requiredItem){ // cập nhật lại

                $_required = json_decode($request->requiredItem);
                $required = Required::find($_required->id);
                if (!str_contains($required->created_at, Carbon::now()->format('Y-m-d'))) {
                    session()->flash('warning', 'Chỉ được sửa dũ liệu của ngày hiện tại');
                    return redirect()->route('admin.checkdevices.create');
                }
                $required->content_form = json_encode($content_form);
                $required->content = $request->description;
                $required->updated_by = $employee->id;
                $required->save();
                DB::commit();
                session()->flash('success', 'Cập nhật thành công');
                return redirect()->route('admin.checkdevices.create');
            }
            $required = Required::where(['completed_by'=>$employee->id,'from_type'=>$requiredType])->where('created_at','like',Carbon::now()->format('Y-m-d').'%')->first();
            if($required){
                session()->flash('warning', 'Chỉ được cập nhật vị trí máy 1 lần trong ngày');
                return redirect()->route('admin.checkdevices.create');
            }
            $count_required = Required::where(['from_type'=>$requiredType])->where('created_at','like',Carbon::now()->format('Y-m-d').'%')->where('content_form','like','%position":"'.$request->position.'%')->count();
            if($count_required > 8){
                session()->flash('warning', 'Chỉ được để tối đa 8 thiết bị trên bàn');
                return redirect()->route('admin.checkdevices.create');
            }
            $required = Required::create([
                'required_department_id' => $employeeDepartment->department_id,
                'code_required' => $requireCode,
                'code' => '',
                'quantity' => 1,
                'created_by' => $employee->id,
                'date_completed'=> Carbon::now(),
                'completed_by'=>$employee->id,
                'usage_status' => 1,
                'content_form' => json_encode($content_form),
                'status' => $status,
                'from_type' => $requiredType,
                'content' => $request->description,
            ]);
            // bộ phận yêu cầu
            $from_depts = $formTypeJobs['from_dept'];
            foreach ($from_depts as $dept_id) {
                $emp_dept = EmployeeDepartment::where('department_id',$dept_id)->whereIn('positions', $formTypeJobs['confirm_by_from_dept'])->pluck('employee_id')->toArray();
                if (count($emp_dept) == 0) {
                    DB::rollBack();
                    session()->flash('error', 'Bộ phận chưa có người quản lý');
                    return redirect()->route('admin.checkdevices.create');
                }
                $signature = SignatureSubmission::create([
                    'required_id' => $required->id,
                    'department_id' => $employeeDepartment->department_id,
                    'positions' => 0,
                    'approve_id' => json_encode($emp_dept),
                    'status' => $status,
                    'signature_id' => $emp_dept[0],

                ]);
            }
            DB::commit();
            session()->flash('success', 'Thêm mới thành công');
            return redirect()->route('admin.checkdevices.create');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error(['error', $e->getMessage()]);
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
    public function update(Request $request)
    {

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
