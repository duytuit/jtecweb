<?php

namespace App\Http\Controllers\Frontend;

use App\Exports\DetailReportExport;
use App\Exports\ExamExport;
use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Models\Accessory;
use App\Models\Employee;
use App\Models\Exam;
use App\Models\InventoryAccessory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        if ($request->type == 1) {
            $data['title'] = 'Thi lần 1 đạt';
        }
        if ($request->type == 2) {
            $data['title'] = 'Thi lần 1 chưa đạt( thi lại )';
        }
        if ($request->type == 3) {
            $data['title'] = 'Thi lần 1 chưa đạt( đào tạo lại )';
        }
        if ($request->type == 4) {
            $data['title'] = 'Chưa thi lần 1';
        }
        if ($request->type == 5) {
            $data['title'] = 'Thi lần 2 đạt';
        }
        if ($request->type == 6) {
            $data['title'] = 'Thi lần 2 chưa đạt( thi lại )';
        }
        if ($request->type == 7) {
            $data['title'] = 'Thi lần 2 chưa đạt( đào tạo lại )';
        }
        if ($request->type == 8) {
            $data['title'] = 'Chưa thi lần 2';
        }
        if ($request->type == 4 || $request->type == 8) {
            $data['lists'] = Employee::whereIn('code', array_column($request->emp, 'code'))->get();
        } else {
            $data['lists'] = Exam::whereIn('id', array_column($request->emp, 'id'))->get();
        }

        return (new DetailReportExport($data))->download('detail-report.xlsx');
    }
    public function exam(Request $request)
    {
        return view('frontend.pages.exam');
    }

    // New exam
    public function examNew(Request $request)
    {
        return view('frontend.pages.examNew');
    }

    public function test()
    {
        $fruits = ArrayHelper::arrayExamPd();
        shuffle($fruits);
        dd($fruits);
    }
    public function test1()
    {
        // $this->addEmployee();
        $this->updateBeginDate();
        // $this->updateType();
        // $this->updateMission();
        //$this->updateScoresAndStatus();
        // $dsgfg= Exam::all();
        // return (new ExamExport( $dsgfg))->download('exam.xlsx');
        //return Exam::query()->get()->downloadExcel('query-download.xlsx')->allFields();

        // $this->addEmployee();
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
        $emp = Employee::where('code', $request->manhanvien)->first();
        // if(!$emp){
        //     return $this->success(['warning'=>'Nhân viên không có trên hệ thống!']);
        // }
        $arrayExam = ArrayHelper::arrayExamPd();
        if (!$request->exists('answer')) {
            return $this->error(['error', 'chưa chọn đáp án']);
        }
        $results = 0;
        foreach ($request->answer as $key => $value) {
            $array_answer = array_filter($arrayExam, fn ($element) => $element['id'] == $key);
            if (count($array_answer) > 0 && current($array_answer)['answer'] == $value) {
                $results++;
            }
        }
        $mytime = Carbon::now();
        $counting_time = $mytime->diffInSeconds(Carbon::parse($request->count_timer));
        $scores = round(($results / count($arrayExam)) * 100);
        $cycle_name = Carbon::parse($request->ngaykiemtra)->format('mY');
        $ngaykiemtra = Carbon::parse($request->ngaykiemtra);

        $conversionDates = ArrayHelper::conversionDate();
        $examinations = 1;
        $date_examinations = [];
        foreach ($conversionDates as $key => $value) {
            if (($value[0] <= $ngaykiemtra->day) && ($ngaykiemtra->day <= $value[1])) {
                $date_examinations[] = $ngaykiemtra->year . '-' . $ngaykiemtra->month . '-' . $value[0];
                $date_examinations[] = $value[1] == 100 ? $ngaykiemtra->endOfMonth()->format('Y-m-d') : $ngaykiemtra->year . '-' . $ngaykiemtra->month . '-' . $value[1];
                $examinations = $key;
            }
        }
        $mission = Exam::where(['code' => $request->manhanvien, 'cycle_name' => $cycle_name, 'examinations' => $examinations])->count();
        try {
            $exam = Exam::create([
                'name' => $emp ? $emp->first_name . ' ' . $emp->last_name : $request->manhanvien, //tên nhân viên
                'code' => $request->manhanvien, // mã nhân viên
                'sub_dept' => $request->congdoan, // công đoạn
                'cycle_name' => $cycle_name, // kỳ thi
                'create_date' => $request->ngaykiemtra, // ngày làm bài thi
                'results' => $results, // tổng số câu trả lời đúng
                'total_questions' => count($arrayExam), // tổng số câu hỏi
                'counting_time' => gmdate('i:s', $counting_time), // thời gian làm bài
                'limit_time' => '05:00', // tổng số câu hỏi
                'data' => json_encode($request->answer), // tổng số câu hỏi
                'status' => $scores > 95 ?  1 : 0, // 0:chưa duyệt,1:đã duyệt
                'mission' =>  $mission + 1, // số lần thi
                'scores' => $scores, // điểm thi
                'examinations' => $examinations, // đợt thi
                'date_examinations' => json_encode($date_examinations), // khoảng thời gian thi
                'type' => $request->type,
            ]);
            return $this->success(compact('exam'));
        } catch (\Exception $e) {
            return $this->error(['error', $e->getMessage()]);
        }
    }
    public function updateType()
    {
        Exam::where('type', 0)->update(['type' => 1]);
        // echo 'thanhf cong';
    }
    public function storeNew(Request $request)
    {
        // dd($request->all());
        $emp = Employee::where(['code' => $request->manhanvien], ['type' => $request->type])->first();
        $groupQuestion = ArrayHelper::groupQuestion();
        $results = 0;
        $scores = 0;
        $totalQuestion = 0;
        foreach ($groupQuestion as $questionItem) {
            $arrayExam = $questionItem['question'];
            $totalQuestion += $questionItem['quantity_question'];
            foreach ($request->answer as $key => $item) {
                $array_answer = array_filter($arrayExam, fn ($element) => $element['id'] == $key);
                if (count($array_answer) > 0 && current($array_answer)['answer'] == $item) {
                    $results++;
                    $scores =  $scores + $questionItem['point'];
                }
            }
        }
        // dd($totalQuestion);
        $mytime = Carbon::now();
        $counting_time = $mytime->diffInSeconds(Carbon::parse($request->count_timer));
        // $scores = round(($results / count($arrayExam)) * 100);
        $cycle_name = Carbon::parse($request->ngaykiemtra)->format('mY');
        $ngaykiemtra = Carbon::parse($request->ngaykiemtra);

        $conversionDates = ArrayHelper::conversionDate();
        $examinations = 1;
        $date_examinations = [];
        foreach ($conversionDates as $key => $value) {
            if (($value[0] <= $ngaykiemtra->day) && ($ngaykiemtra->day <= $value[1])) {
                $date_examinations[] = $ngaykiemtra->year . '-' . $ngaykiemtra->month . '-' . $value[0];
                $date_examinations[] = $value[1] == 100 ? $ngaykiemtra->endOfMonth()->format('Y-m-d') : $ngaykiemtra->year . '-' . $ngaykiemtra->month . '-' . $value[1];
                $examinations = $key;
            }
        }
        $mission = Exam::where(['code' => $request->manhanvien, 'cycle_name' => $cycle_name, 'examinations' => $examinations])->count();
        try {
            $exam = Exam::create([
                'name' => $emp ? $emp->first_name . ' ' . $emp->last_name : $request->manhanvien, //tên nhân viên
                'code' => $request->manhanvien, // mã nhân viên
                'sub_dept' => $request->congdoan, // công đoạn
                'cycle_name' => $cycle_name, // kỳ thi
                'create_date' => $request->ngaykiemtra, // ngày làm bài thi
                'results' => $results, // tổng số câu trả lời đúng
                'total_questions' => $totalQuestion, // tổng số câu hỏi
                'counting_time' => gmdate('i:s', $counting_time), // thời gian làm bài
                'limit_time' => '05:00', // tổng số câu hỏi
                'data' => json_encode($request->answer), // tổng số câu hỏi
                'status' => $scores > 79 ?  1 : 0, // 0:chưa duyệt,1:đã duyệt
                'mission' =>  $mission + 1, // số lần thi
                'scores' => $scores, // điểm thi
                'examinations' => $examinations, // đợt thi
                'date_examinations' => json_encode($date_examinations), // khoảng thời gian thi
                'type' => $request->type,
            ]);
            return $this->success(compact('exam'));
        } catch (\Exception $e) {
            return $this->error(['error', $e->getMessage()]);
        }
    }

    public function addEmployee()
    {
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
            240317 =>    "Nguyễn Thị Thúy",
            // 24031656 =>    "Nguyễn Thị Thúy 123",
            // 240341656 =>    "Nguyễn Thị Thúy 1235",
            240405 =>    "Nguyễn Thị Ngọc Lan",
            240406 =>    "Nguyễn Thị Thu",
            240407 =>    "Lê Thị Thanh Thủy",
            240408 =>    "Bùi Thị Lụa",
            240410 =>    "Lê Thị Thu Huyền",
            240411 =>    "Nguyễn Thị Trang",
            240412 =>    "Trương Thị Ánh",
            240415 =>    "Lê Ngọc Mai",
            240416 =>    "Nguyễn Phạm Tường Vy",
            240417 =>    "Đinh Thị Hằng",
            240424 =>    "Nguyễn Thị Nhiên",
        ];

        foreach ($employee as $key => $value) {
            $emp = Employee::where('code', $key)->first();
            if (!$emp) {
                $parts = explode(" ", $value);
                if (count($parts) > 1) {
                    $lastname = array_pop($parts);
                    $firstname = implode(" ", $parts);
                } else {
                    $firstname = $value;
                    $lastname = " ";
                }
                Employee::create([
                    'code' => $key,
                    'first_name' => $firstname,
                    'last_name' => $lastname,
                    'created_by' => 1
                ]);
            }
        }
    }



    public function updateScoresAndStatus()
    {
        $fdgfdgf = Exam::all();
        foreach ($fdgfdgf as $key => $value) {
            $scores = round(($value->results / $value->total_questions) * 100);
            $value->update([
                'scores' => $scores + 1,
                'status' => $scores > 80 ?  1 : 0
            ]);
        }
    }

    public function updateCreateDate()
    {
        $fdgfdgf = Employee::all();
        foreach ($fdgfdgf as $key => $value) {

            $fdgf =  Exam::select('id')->where('code', $value->code)
                ->where('cycle_name', 42024)
                ->where('examinations', 1)
                ->where('status', 1)
                ->groupBy('code')->count();
            echo $fdgf . '============</br>';
            if ($fdgf > 1) {
                $fdgf345 =  Exam::select('code', DB::raw('MAX(id) as _id'))->where('code', $value->code)
                    ->where('cycle_name', 42024)
                    ->where('examinations', 1)
                    ->where('status', 1)
                    ->groupBy('code')
                    ->first();
                $fdgdfg = Exam::find($fdgf345->_id);
                $fdgdfg->update([
                    'examinations' => 2,
                    'create_date' => '2024-04-19',
                    'mission' =>  1 // số lần thi
                ]);
                echo $fdgdfg->id . ' code ' . $fdgdfg->code . '</br>';
            }
        }
    }
    public function updateExaminations()
    {
        $fdgfdgf = Exam::all();
        foreach ($fdgfdgf as $key1 => $value1) {
            $conversionDates = ArrayHelper::conversionDate();
            $examinations = 0;
            $date_examinations = [];
            $ngaykiemtra = Carbon::parse($value1->create_date);
            foreach ($conversionDates as $key => $value) {
                if (($value[0] <= $ngaykiemtra->day) && ($ngaykiemtra->day <= $value[1])) {
                    $date_examinations[] = $ngaykiemtra->year . '-' . $ngaykiemtra->month . '-' . $value[0];
                    $date_examinations[] = $value[1] == 100 ? $ngaykiemtra->endOfMonth()->format('Y-m-d') : $ngaykiemtra->year . '-' . $ngaykiemtra->month . '-' . $value[1];
                    $examinations = $key;
                }
            }
            $value1->update([
                'examinations' => $examinations, // điểm thi
                'date_examinations' => json_encode($date_examinations), // điểm thi
            ]);
        }
    }
    public function updateMission()
    {
        $fdgfdgf = Exam::orderBy('code')->orderBy('cycle_name')->orderBy('created_at')->get();
        $mission = 1;
        $code = 0;
        foreach ($fdgfdgf as $key => $value) {
            if ($value->code != $code) {
                $code = $value->code;
                $mission = 1;
            } else {
                $mission++;
            }
            $value->update([
                'mission' => $mission
            ]);
        }
    }
    public function updateCode()
    {
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
                if ($value1 == $value->name) {
                    $value->update([
                        'code' => $key1
                    ]);
                }
            }
        }
    }
    public function updateBeginDate()
    {
        $fdgfdgf = Employee::all();
        $employee = [
            240317 =>    "11/3/2024",
            240405 =>    "16/4/2024",
            240406 =>    "16/4/2024",
            240407 =>    "16/4/2024",
            240408 =>    "16/4/2024",
            240410 =>    "22/4/2024",
            240411 =>    "22/4/2024",
            240412 =>    "22/4/2024",
            240415 =>    "22/4/2024",
            240416 =>    "22/4/2024",
            240417 =>    "22/4/2024",
            240424 =>    "22/4/2024",
        ];
        foreach ($fdgfdgf as $key => $value) {
            foreach ($employee as $key1 => $value1) {
                if ($key1 == $value->code) {
                    $beginDate = Carbon::createFromFormat('d/m/Y', $value1);
                    $value->update([
                        'begin_date_company' => $beginDate->format('Y-m-d')
                    ]);
                }
            }
        }
    }
}
