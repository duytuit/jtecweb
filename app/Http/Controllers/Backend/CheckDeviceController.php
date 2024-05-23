<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\CheckDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Required;
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

        $checkDevice = new CheckDevice();
        $data['getWifiSSID'] = $checkDevice->getWifiSSID();
        $data['getComputerName'] = $checkDevice->getComputerName();
        $data['getProcessorInfo'] = $checkDevice->getProcessorInfo();
        $data['getOSInfo'] = $checkDevice->getOSInfo();
        $data['diskInfo'] = $checkDevice->getDiskInfo();
        $data['getTotal'] = $checkDevice->getTotal();
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
        //
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
