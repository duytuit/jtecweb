<?php

namespace App\Console\Commands;

use App\Helpers\RedisHelper;
use App\Models\Accessory;
use App\Models\LogImport;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncInventoryAccessoriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:inventory_accessory';

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
        $time_start = microtime(true);

        do {
            $get_detail = null;
            try {
                $details = RedisHelper::queuePop(['inventory_accessory']);
                if ($details == null) {
                    break;
                }
                $get_detail = $details;
                $details = json_decode($details);
                echo $details->code."\n";
                $DFW_Z20F = DB::connection('oracle')->table('DFW_Z20F')
                                                 ->where('場所C', 'like', $details->location_c.'%')
                                                 ->where('品目K', 'like', $details->location_k.'%')
                                                 ->where('品目C', 'like', $details->code.'%')->orderBy('品目C')->orderBy('年月度','desc')->first();
                $inventory = (int)$details->inventory;
                $unit = $details->unit;
                if($DFW_Z20F){
                    $inventory =  (int)trim($DFW_Z20F->当月在庫数);

                    $DFW_Z30F = DB::connection('oracle')->table('DFW_Z30F')
                                ->where('場所C', 'like', $details->location_c.'%')
                                ->where('品目K', 'like', $details->location_k.'%')
                                ->where('在庫受払日', 'like', Carbon::now()->format('Y/m').'%')
                                ->where('新規登録日', 'like', Carbon::now()->format('Y/m').'%')
                                ->where('品目C', 'like', $details->code.'%')->orderBy('品目C')->orderBy('新規登録日','desc')->get();

                    if($DFW_Z30F->count() > 0){

                        foreach ($DFW_Z30F as $key => $value) {
                            $unit = trim($value->単位);
                            if( trim($value->品目c) == $details->code){
                                if( trim($value->受払seq2) == '1'){ // Xuất
                                    $inventory = $inventory- (int)trim($value->数量);
                                }
                                if( trim($value->受払seq2) == '0'){ // Nhập
                                    $inventory = $inventory+ (int)trim($value->数量);
                                }
                            }
                        }
                        if($inventory != $details->inventory){
                            echo  $inventory."\n";
                            Accessory::where('id',$details->id)->update([
                                'inventory'=>$inventory,
                                'unit'=>$unit
                            ]);
                        }

                    }
                }
                $time_end = microtime(true);
                $time = $time_end - $time_start;
            } catch (\Exception $e) {
                LogImport::create([
                    'type' => 1,
                    'status' => 0,
                    'data' => $get_detail,
                    'messages' => $e->getLine().'||'.$e->getTraceAsString()
                ]);
            }
        } while ($details != null || $time < 55);

        return true;
    }
}
