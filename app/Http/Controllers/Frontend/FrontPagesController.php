<?php

namespace App\Http\Controllers\Frontend;

use App\Exports\DetailReportExport;
use App\Exports\ExamExport;
use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontPagesController extends Controller
{
    /**
     * homePage
     *
     * HomePage of Application
     *
     * @return void
     */
    public function index()
    {
        return view('frontend.pages.index');
    }
    public function detailReport(Request $request)
    {

        if($request->type == 1){
            $data['title'] = 'Thi lần 1 đạt';
        }
        if($request->type == 2){
            $data['title'] = 'Thi lần 1 chưa đạt';
        }
        if($request->type == 3){
            $data['title'] = 'Chưa thi lần 1';
        }
        if($request->type == 4){
            $data['title'] = 'Thi lần 2 đạt';
        }
        if($request->type == 5){
            $data['title'] = 'Thi lần 2 chưa đạt';
        }
        if($request->type == 6){
            $data['title'] = 'Chưa thi lần 2';
        }
        $data['lists'] = Employee::whereIn('code',array_column($request->emp,'code'))->get();
        return (new DetailReportExport($data))->download('detail-report.xlsx');
    }
    public function exam()
    {
        $start_time=Carbon::now();
        return view('frontend.pages.exam',['start_time'=>$start_time]);
    }
    public function test()
    {
        $fruits = ArrayHelper::arrayExamPd();
        shuffle($fruits);
        dd($fruits);
    }
    public function test1()
    {
        // $this->updateMission();
        //$this->updateScoresAndStatus();
       // $dsgfg= Exam::all();
       // return (new ExamExport( $dsgfg))->download('exam.xlsx');
        //return Exam::query()->get()->downloadExcel('query-download.xlsx')->allFields();

        //$this->addEmployee();
        //dd($fruits);
        // mảng cần tìm
        //$key=array_search("R", array_column(json_decode(json_encode($fruits),TRUE), 'answer'));
        //dd($fruits[$key]);
        //unset($fruits[$key]);
        //$firstThreeElements = array_slice($fruits, 0, 3);
        // dd($firstThreeElements);

        // hàm đảo đáp án
       // $fruits = ArrayHelper::arrayExamPd();
       // $arrayFiltered = array_filter($fruits, fn($element) => $element['answer'] == "R");
       // $array_answer = array_column($fruits, 'answer');
        // $arrayFiltered = array_filter($array_answer, fn($element) => $element != "R");
        // $firstThreeElements = array_slice($arrayFiltered, 0, 3);
        // array_push($firstThreeElements, "R");
        // shuffle($firstThreeElements);
       // dd(count($arrayFiltered));
    }
    public function store(Request $request)
    {
       //dd($request->exists('answer'));
        $emp = Employee::where('code',$request->manhanvien)->first();
        // if(!$emp){
        //     return $this->success(['warning'=>'Nhân viên không có trên hệ thống!']);
        // }
        $arrayExam = ArrayHelper::arrayExamPd();
        if(!$request->exists('answer')){
            return $this->error(['error', 'chưa chọn đáp án']);
        }
        $results=0;
        foreach ($request->answer as $key => $value) {
            $array_answer = array_filter($arrayExam, fn($element) => $element['id'] == $key);
            if(count($array_answer)>0 && current($array_answer)['answer'] == $value){
                $results++;
            }
        }
        $mytime = Carbon::now();
        $counting_time = $mytime->diffInSeconds(Carbon::parse($request->count_timer));
        $scores = round(($results/count($arrayExam))*100);
        $cycle_name = Carbon::parse($request->ngaykiemtra)->format('mY');
        $mission = Exam::where(['code'=>$request->manhanvien,'cycle_name'=>$cycle_name])->count();
        try {
            $exam = Exam::create([
                'name' =>$emp? $emp->first_name.' '.$emp->last_name : $request->manhanvien, //tên nhân viên
                'code' => $request->manhanvien, // mã nhân viên
                'sub_dept' => $request->congdoan, // công đoạn
                'cycle_name' => $cycle_name, // kỳ thi
                'create_date' => $request->ngaykiemtra, // ngày làm bài thi
                'results' => $results,// tổng số câu trả lời đúng
                'total_questions' => count($arrayExam),// tổng số câu hỏi
                'counting_time' => gmdate('i:s',$counting_time),// thời gian làm bài
                'limit_time' => '05:00',// tổng số câu hỏi
                'data' => json_encode($request->answer),// tổng số câu hỏi
                'status' => $scores > 95 ?  1:0,// 0:chưa duyệt,1:đã duyệt
                'mission' =>  $mission+1,// số lần thi
                'scores' => $scores,// điểm thi
            ]);
            return $this->success(compact('exam'));
        } catch (\Exception $e) {
            return $this->error(['error', $e->getMessage()]);
        }
    }

    public function addEmployee(){
        $employee = [
            10142 =>    "Đàm Thị Hương",
            10352 =>    "Nguyễn Thị Kim Hoa",
            130206 =>    "Thịnh Thị Thái",
            130207 =>    "Ngô Thị Đậu",
            130323 =>    "Hoàng Thị Tình",
            130907 =>    "Nguyễn Thị Mỹ Hưởng",
            130947 =>    "Vũ Thị Yến",
            130976 =>    "Hoàng Thị Quyết",
            131102 =>    "Nguyễn Thị Anh",
            131107 =>    "Ngô Thị Hồng Nhung",
            131108 =>    "Phan Thị Loan",
            140204 =>    "Đinh Thị Trì",
            140303 =>    "Nguyễn Thị Lan",
            140322 =>    "Nguyễn Thị Lâm",
            140326 =>    "Trần Thị Thùy",
            140328 =>    "Lê Thị Hoa",
            140416 =>    "Dương Thị Dung",
            140519 =>    "Lâm Thị Thu Hằng",
            140787 =>    "Thân Thị Mai",
            1407100 =>    "Nguyễn Thị Minh Ngọc",
            1410119 =>    "Trần Thị Thu Thảo",
            141182 =>    "Phan Thị Loan",
            141197 =>    "Bùi Thị Nhâm",
            151106 =>    "Lưu Thị Phương",
            160417 =>    "Đoàn Thị Hạnh",
            160711 =>    "Hồ Thị Lê",
            160886 =>    "Nguyễn Minh Hòa",
            160933 =>    "Đặng Thị Hồng",
            1609182 =>    "Ngô Thị Huyền Trang",
            161125 =>    "Phùng Thị Thương",
            161176 =>    "Đinh Thị Nhã",
            1702134 =>    "Vũ Thị Như Quỳnh",
            170320 =>    "Nguyễn Thị Lý",
            170485 =>    "Vũ Thị Hương",
            170494 =>    "Lê Thị Kiền",
            170495 =>    "Ngô Thị Hiểu",
            170560 =>    "Bùi Trọng Doanh",
            170610 =>    "Đàm Văn Ninh",
            170648 =>    "Phùng Thị Phượng",
            170665 =>    "Lê Thị Yến",
            170751 =>    "Cao Thị Ánh Nguyệt",
            1707127 =>    "Trịnh Thị Thuần",
            170866 =>    "Đặng Khánh Linh",
            171002 =>    "Đinh Thị Hương",
            171050 =>    "Nguyễn Thị Tính",
            180371 =>    "Nguyễn Thị Hằng Nga",
            180393 =>    "Vi Thanh Sơn",
            1803145 =>    "Bùi Văn Anh",
            180817 =>    "Đinh Hoàng Giang",
            180823 =>    "Nguyễn Ngọc Ánh",
            180906 =>    "Võ Thị Hồng Nhung",
            181044 =>    "Nguyễn Văn Việt",
            181091 =>    "Nguyễn Thị Hợp",
            190457 =>    "Lê Thị Thúy Hồng",
            190529 =>    "Hoàng Thế Đạt",
            210301 =>    "Trần Thị Như Quỳnh",
            2103129 =>    "Nguyễn Văn Thanh",
            2103229 =>    "Vũ Thị Hằng",
            211059 =>    "Nguyễn Văn Tuấn",
            211068 =>    "Nguyễn Văn Tuân",
            220440 =>    "Lê Văn Chương",
            220454 =>    "Đoàn Đức Võ",
            2209109 =>    "Nguyễn Văn Tuyền",
            2211158 =>    "Nguyễn Thị Thuỳ",
            230209 =>    "Nguyễn Văn Nam",
            2302221 =>    "Lục Văn Châu",
            230317 =>    "Võ Văn Thật",
            230322 =>    "Đoàn Ngọc Oanh",
            230394 =>    "Phạm Văn Nam",
            2303152 =>    "Lê Đình Văn",
            230573 =>    "Lưu Thị Hương Ly",
            230867 =>    "Trần Thị Thảo",
            231164 =>    "Hoàng Thị Yên",
            231166 =>    "Đỗ Thị Nhung",
            231218 =>    "Nguyễn Văn Quân",
            240317 =>    "Nguyễn Thị Thúy"
        ];

        foreach ($employee as $key => $value) {
            $emp = Employee::where('code',$key)->first();
            if(!$emp){
                $parts = explode(" ", $value);
                if(count($parts) > 1) {
                    $lastname = array_pop($parts);
                    $firstname = implode(" ", $parts);
                }else{
                    $firstname = $value;
                    $lastname = " ";
                }
                Employee::create([
                    'code'=> $key,
                    'first_name'=> $firstname,
                    'last_name'=> $lastname,
                    'created_by'=> 1
                ]);
            }
        }
    }
    public function updateScoresAndStatus(){
           $fdgfdgf = Exam::all();
           foreach ($fdgfdgf as $key => $value) {
               $scores = round(($value->results/$value->total_questions)*100);
               $value->update([
                     'scores' =>$scores,
                     'status' =>$scores > 95 ?  1:0
               ]);
           }
    }
    public function updateMission(){
        $fdgfdgf = Exam::orderBy('code')->orderBy('cycle_name')->orderBy('created_at')->get();
        $mission = 1;
        $code=0;
        foreach ($fdgfdgf as $key => $value) {
            if($value->code !=$code){
                $code = $value->code;
                $mission = 1;
            }else{
                $mission++;
            }
            $value->update([
                  'mission' =>$mission
            ]);
        }
    }
    public function updateCode(){
        $fdgfdgf = Exam::all();
        $employee = [
            10142 =>    "Đàm Thị Hương",
            10352 =>    "Nguyễn Thị Kim Hoa",
            130206 =>    "Thịnh Thị Thái",
            130207 =>    "Ngô Thị Đậu",
            130323 =>    "Hoàng Thị Tình",
            130907 =>    "Nguyễn Thị Mỹ Hưởng",
            130947 =>    "Vũ Thị Yến",
            130976 =>    "Hoàng Thị Quyết",
            131102 =>    "Nguyễn Thị Anh",
            131107 =>    "Ngô Thị Hồng Nhung",
            131108 =>    "Phan Thị Loan",
            140204 =>    "Đinh Thị Trì",
            140303 =>    "Nguyễn Thị Lan",
            140322 =>    "Nguyễn Thị Lâm",
            140326 =>    "Trần Thị Thùy",
            140328 =>    "Lê Thị Hoa",
            140416 =>    "Dương Thị Dung",
            140519 =>    "Lâm Thị Thu Hằng",
            140787 =>    "Thân Thị Mai",
            1407100 =>    "Nguyễn Thị Minh Ngọc",
            1410119 =>    "Trần Thị Thu Thảo",
            141182 =>    "Phan Thị Loan",
            141197 =>    "Bùi Thị Nhâm",
            151106 =>    "Lưu Thị Phương",
            160417 =>    "Đoàn Thị Hạnh",
            160711 =>    "Hồ Thị Lê",
            160886 =>    "Nguyễn Minh Hòa",
            160933 =>    "Đặng Thị Hồng",
            1609182 =>    "Ngô Thị Huyền Trang",
            161125 =>    "Phùng Thị Thương",
            161176 =>    "Đinh Thị Nhã",
            1702134 =>    "Vũ Thị Như Quỳnh",
            170320 =>    "Nguyễn Thị Lý",
            170485 =>    "Vũ Thị Hương",
            170494 =>    "Lê Thị Kiền",
            170495 =>    "Ngô Thị Hiểu",
            170560 =>    "Bùi Trọng Doanh",
            170610 =>    "Đàm Văn Ninh",
            170648 =>    "Phùng Thị Phượng",
            170665 =>    "Lê Thị Yến",
            170751 =>    "Cao Thị Ánh Nguyệt",
            1707127 =>    "Trịnh Thị Thuần",
            170866 =>    "Đặng Khánh Linh",
            171002 =>    "Đinh Thị Hương",
            171050 =>    "Nguyễn Thị Tính",
            180371 =>    "Nguyễn Thị Hằng Nga",
            180393 =>    "Vi Thanh Sơn",
            1803145 =>    "Bùi Văn Anh",
            180817 =>    "Đinh Hoàng Giang",
            180823 =>    "Nguyễn Ngọc Ánh",
            180906 =>    "Võ Thị Hồng Nhung",
            181044 =>    "Nguyễn Văn Việt",
            181091 =>    "Nguyễn Thị Hợp",
            190457 =>    "Lê Thị Thúy Hồng",
            190529 =>    "Hoàng Thế Đạt",
            210301 =>    "Trần Thị Như Quỳnh",
            2103129 =>    "Nguyễn Văn Thanh",
            2103229 =>    "Vũ Thị Hằng",
            211059 =>    "Nguyễn Văn Tuấn",
            211068 =>    "Nguyễn Văn Tuân",
            220440 =>    "Lê Văn Chương",
            220454 =>    "Đoàn Đức Võ",
            2209109 =>    "Nguyễn Văn Tuyền",
            2211158 =>    "Nguyễn Thị Thuỳ",
            230209 =>    "Nguyễn Văn Nam",
            2302221 =>    "Lục Văn Châu",
            230317 =>    "Võ Văn Thật",
            230322 =>    "Đoàn Ngọc Oanh",
            230394 =>    "Phạm Văn Nam",
            2303152 =>    "Lê Đình Văn",
            230573 =>    "Lưu Thị Hương Ly",
            230867 =>    "Trần Thị Thảo",
            231164 =>    "Hoàng Thị Yên",
            231166 =>    "Đỗ Thị Nhung",
            231218 =>    "Nguyễn Văn Quân",
            240317 =>    "Nguyễn Thị Thúy"
        ];
        foreach ($fdgfdgf as $key => $value) {
            foreach ($employee as $key1 => $value1) {
                if( $value1 == $value->name){
                    $value->update([
                        'code' =>$key1
                  ]);
                }
            }
        }
    }

}
