<?php

namespace App\Console\Commands;

use App\Helpers\RedisHelper;
use App\Models\Accessory;
use App\Models\EmployeeProductionPlan;
use App\Models\LogImport;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class SyncProductionPlanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:production_plan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $details = null;
        try {
            set_time_limit(0);
            $details = (new FastExcel)->sheet(2)->withoutHeaders()->import('//192.168.207.6/JtecData/QUAN LY SAN XUAT/VUI/コマツインドの出荷日程  HT MỚI.xlsx');
            if (count($details) == 0) {
                LogImport::create([
                    'type' => 1,
                    'status' => 0,
                    'data' => json_encode($details),
                    'messages' => "Không tìm thấy dữ liệu"
                ]);
                return false;
            }

            foreach ($details as $key => $value) {
                if ($key > 2) {
                    // dd(2);
                    $employeeProductionPlan  = EmployeeProductionPlan::where('lot_no',$value[1])->first();
                    if($employeeProductionPlan){
                        $employeeProductionPlan->code = $value[2];
                        $employeeProductionPlan->lot_no = $value[1];
                        $employeeProductionPlan->hangdangdo_cam = $value[3];
                        $employeeProductionPlan->hangdangdo_lrap = $value[4];
                        $employeeProductionPlan->hangdangdo_buredo = $value[5];
                        $employeeProductionPlan->hangdangdo_kttm = $value[6];
                        $employeeProductionPlan->hangdangdo_ktnq = $value[7];
                        $employeeProductionPlan->ton_kho = $value[8];
                        $employeeProductionPlan->thu2_le = $value[9];
                        $employeeProductionPlan->thu3_air = $value[10];
                        $employeeProductionPlan->thu4_le = $value[11];
                        $employeeProductionPlan->thu5_le = $value[12];
                        $employeeProductionPlan->thu5_air = $value[13];
                        $employeeProductionPlan->thu6_air = $value[14];
                        $employeeProductionPlan->thu6_sea_osaka = $value[15];
                        $employeeProductionPlan->thu6_sea_tokyo = $value[16];
                        $employeeProductionPlan->mau = $value[17];
                        $employeeProductionPlan->hangxuatchualam_dap = $value[18];
                        $employeeProductionPlan->hangxuatchualam_cam = $value[19];
                        $employeeProductionPlan->hangxuatchualam_lrap = $value[20];
                        $employeeProductionPlan->hangxuatchualam_buredo = $value[21];
                        $employeeProductionPlan->hangxuatchualam_kttm = $value[22];
                        $employeeProductionPlan->hangxuatchualam_ktnq = $value[23];
                        $employeeProductionPlan->don_gia = $value[24];
                        $employeeProductionPlan->so_luong = $value[25];
                        $employeeProductionPlan->gia_cong = $value[27];
                        $employeeProductionPlan->soluongdaycatchualam_dap = $value[34];
                        $employeeProductionPlan->soluongdaycatchualam_cam = $value[35];
                        $employeeProductionPlan->soluongdaycatchualam_lrap = $value[36];
                        $employeeProductionPlan->soluongdaycatchualam_buredo = $value[37];
                        $employeeProductionPlan->soluongdaycatchualam_kttm = $value[38];
                        $employeeProductionPlan->soluongdaycatchualam_ktnq = $value[39];
                        $employeeProductionPlan->tonglichxuat_dongia = $value[40];
                        $employeeProductionPlan->tonglichxuat_soluong = $value[41];
                        $employeeProductionPlan->tonglichxuat_soluongxuat = $value[42];
                        $employeeProductionPlan->soluonghangxuat_dap = $value[43];
                        $employeeProductionPlan->soluonghangxuat_cam = $value[44];
                        $employeeProductionPlan->soluonghangxuat_lrap = $value[45];
                        $employeeProductionPlan->soluonghangxuat_buredo = $value[46];
                        $employeeProductionPlan->soluonghangxuat_kttm = $value[47];
                        $employeeProductionPlan->soluonghangxuat_ktnq = $value[48];
                        $employeeProductionPlan->soluonghangxuatdaycat_dap = $value[49];
                        $employeeProductionPlan->soluonghangxuatdaycat_cam = $value[50];
                        $employeeProductionPlan->soluonghangxuatdaycat_lrap = $value[51];
                        $employeeProductionPlan->soluonghangxuatdaycat_buredo = $value[52];
                        $employeeProductionPlan->soluonghangxuatdaycat_kttm = $value[53];
                        $employeeProductionPlan->soluonghangxuatdaycat_ktnq = $value[54];
                        $employeeProductionPlan->save();
                    }else{
                        EmployeeProductionPlan::create([
                            'code' => $value[2],
                            'lot_no' => $value[1],
                            'hangdangdo_cam' => $value[3],
                            'hangdangdo_lrap' => $value[4],
                            'hangdangdo_buredo' => $value[5],
                            'hangdangdo_kttm' => $value[6],
                            'hangdangdo_ktnq' => $value[7],
                            'ton_kho' => $value[8],
                            'thu2_le' => $value[9],
                            'thu3_air' => $value[10],
                            'thu4_le' => $value[11],
                            'thu5_le' => $value[12],
                            'thu5_air' => $value[13],
                            'thu6_air' => $value[14],
                            'thu6_sea_osaka' => $value[15],
                            'thu6_sea_tokyo' => $value[16],
                            'mau' => $value[17],
                            'hangxuatchualam_dap' => $value[18],
                            'hangxuatchualam_cam' => $value[19],
                            'hangxuatchualam_lrap' => $value[20],
                            'hangxuatchualam_buredo' => $value[21],
                            'hangxuatchualam_kttm' => $value[22],
                            'hangxuatchualam_ktnq' => $value[23],
                            'don_gia' => $value[24],
                            'so_luong' => $value[25],
                            'gia_cong' => $value[27],
                            'soluongdaycatchualam_dap' => $value[34],
                            'soluongdaycatchualam_cam' => $value[35],
                            'soluongdaycatchualam_lrap' => $value[36],
                            'soluongdaycatchualam_buredo' => $value[37],
                            'soluongdaycatchualam_kttm' => $value[38],
                            'soluongdaycatchualam_ktnq' => $value[39],
                            'tonglichxuat_dongia' => $value[40],
                            'tonglichxuat_soluong' => $value[41],
                            'tonglichxuat_soluongxuat' => $value[42],
                            'soluonghangxuat_dap' => $value[43],
                            'soluonghangxuat_cam' => $value[44],
                            'soluonghangxuat_lrap' => $value[45],
                            'soluonghangxuat_buredo' => $value[46],
                            'soluonghangxuat_kttm' => $value[47],
                            'soluonghangxuat_ktnq' => $value[48],
                            'soluonghangxuatdaycat_dap' => $value[49],
                            'soluonghangxuatdaycat_cam' => $value[50],
                            'soluonghangxuatdaycat_lrap' => $value[51],
                            'soluonghangxuatdaycat_buredo' => $value[52],
                            'soluonghangxuatdaycat_kttm' => $value[53],
                            'soluonghangxuatdaycat_ktnq' => $value[54]
                         ]);
                    }
                }
            }
            RedisHelper::setKey('update_EmployeeProductionPlan',json_encode(['time'=>Carbon::now(),'status'=>1]));
        } catch (\Exception $e) {
            // print_r( $e->getLine() . '||' . $e->getTraceAsString());
            RedisHelper::setKey('update_EmployeeProductionPlan',json_encode(['time'=>Carbon::now(),'status'=>2]));
            LogImport::create([
                'type' => 1,
                'status' => 0,
                'data' => json_encode($details),
                'messages' => $e->getLine() . '||' . $e->getTraceAsString()
            ]);
        }

        return true;
    }
}
