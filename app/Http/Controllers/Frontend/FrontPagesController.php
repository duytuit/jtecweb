<?php

namespace App\Http\Controllers\Frontend;

use App\Exports\DetailReportExport1;
use App\Exports\DetailReportExport;
use App\Helpers\ArrayHelper;
use App\Helpers\RedisHelper;
use App\Http\Controllers\Controller;
use App\Imports\EmpImport;
use App\Models\Accessory;
use App\Models\Admin;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeDepartment;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Schema\Blueprint;

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
    public function detailReport1(Request $request)
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

        return (new DetailReportExport1($data))->download('detail-report.xlsx');
    }
    public function exam(Request $request)
    {
        return view('frontend.pages.exam');
    }

    // New exam
    public function examNew(Request $request)
    {
        $getEmployeeBeginOneMonth = Employee::whereDate('begin_date_company', '>=', (Carbon::now()->subMonths(1))->format('Y-m-d'))->Where('code', $request->code)->first();

        if (!$getEmployeeBeginOneMonth) {
            return redirect()->back()->with('warning', 'Mã code không hợp lệ');
        } else {
            return view('frontend.pages.examNew');
        }
    }

    public function test()
    {
        $fruits = ArrayHelper::arrayExamPd();
        shuffle($fruits);
        dd($fruits);
    }
    public function test1()
    {
        $dfgdfg =trim(str_replace('_','',str_replace('/', "_\_", '//192.168.207.6/jtecdata/PDF GOP/CAM/SƠ ĐỒ CẮM/ĐẦU 1/12H/12HD010K.pdf')));
        dd( $dfgdfg);
        // // tồn tháng 4
        //  $store = DB::connection('oracle')->table('DFW_Z20F')
        //     ->where('場所C', 'like', '0111%')
        //     ->where('品目K', 'like', '7'.'%')
        //     ->where('品目C', 'like', 'AVS2R%')->orderBy('品目C')->orderBy('年月度','desc')->first();
        //  dd($store);
       // Nhập và Xuất
        // $store = DB::connection('oracle')->table('DFW_Z30F')
        // ->where('場所C', 'like', '0111%')
        // ->where('品目K', 'like', '7'.'%')
        // ->where('在庫受払日', 'like', Carbon::now()->format('Y/m').'%')
        // ->where('新規登録日', 'like', Carbon::now()->format('Y/m').'%')
        // ->where('品目C', 'like', 'AVS2R%')->orderBy('品目C')->orderBy('新規登録日','desc')->get();
        //  dd($store);

        // Nhập ok
        //  $store = DB::connection('oracle')->table('DFW_H30F')
        // ->where('在庫場所C', 'like', '0111%')
        // ->where('品目K', 'like', '7'.'%')
        // ->where('品目C', 'like', 'AVS2R%')->orderBy('品目C')->orderBy('新規登録日','desc')->limit(100)->get();
        //  dd($store);
        //     $accessory = Accessory::where('location_k',7)->orderBy('id')->limit(100)->get();
        //    foreach ($accessory as $key => $value) {
        //       RedisHelper::queueSet('inventory_accessory',$value);
        //    }
        // $date =explode("/",'20/09/1985');
        // dd(  'R_'.now()->format('Ymdhis'));
        // $this->add_employee_to_department();
        // $this->add_user_and_pass();
        $this->remaneTable();
        // $this->add_employeeTableId_to_admin_table_employee_id();
        // $this->addEmployee();
        // $this->updateBeginDate();
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
    public function add_employee_to_department()
    {
        $employees = Employee::all();
        foreach ($employees as $employee) {
            $department = EmployeeDepartment::create([
                'employee_id' => $employee->id,
                'department_id' => 1,
                'positions' => 0,
                'created_by' => 1,
            ]);
            // return $this->success(compact('department'));
        }
    }

    public function add_employeeTableId_to_admin_table_employee_id()
    {
        $employees = Employee::all();
        foreach ($employees as $employee) {
            // echo $employee->code;
            $admin = Admin::Where('username', $employee->code)->first();
            // echo $admin;
            if ($admin) {
                $admin->employee_id = $employee->id;
                $admin->save();
            }
        }
    }
    public function add_user_and_pass()
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            $admin = Admin::Where('username', $employee->code)->first();
            if (!$admin) {
                $admin = new Admin();
                $admin->first_name = $employee->first_name;
                $admin->last_name = $employee->last_name;
                $admin->username = $employee->code;
                $admin->email = @$employee->email ? @$employee->email : $employee->code . 'exam@exam.com';
                $admin->password = Hash::make($employee->code);
                $admin->status = 1;
                $admin->created_at = Carbon::now();
                $admin->created_by = Auth::id();
                $admin->updated_at = Carbon::now();
                $admin->save();

                // Assign Roles
                $admin->assignRole('Worker');
            }
        }
    }

    public function remaneTable()
    {
        if (Schema::hasColumn('signature_submissions', 'sign_instead')) {
            Schema::table('signature_submissions', function (Blueprint $table) {
                $table->renameColumn('sign_instead', 'signature_id');
            });
        }

        if (Schema::hasColumn('employees', 'image')) {
            Schema::table('employees', function (Blueprint $table) {
                $table->renameColumn('image', 'avatar');
            });
        }
    }
    public function store(Request $request)
    {
        //dd($request->exists('answer'));
        $emp = Employee::where('code', $request->manhanvien)->first();
        $emp_dept = EmployeeDepartment::where('employee_id', $emp->id)->first();
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
                'sub_dept' => @$emp_dept ? @$emp_dept->department_id : 0, // công đoạn
                'cycle_name' => $cycle_name, // kỳ thi
                'create_date' => $request->ngaykiemtra, // ngày làm bài thi
                'results' => $results, // tổng số câu trả lời đúng
                'total_questions' => count($arrayExam), // tổng số câu hỏi
                'counting_time' => gmdate('i:s', $counting_time), // thời gian làm bài
                'limit_time' => '05:00', // tổng số câu hỏi
                'data' => json_encode($request->answer), // tổng số câu hỏi
                'status' => $scores > 95 ? 1 : 0, // 0:chưa duyệt,1:đã duyệt
                'mission' => $mission + 1, // số lần thi
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
        $emp_dept = EmployeeDepartment::where('employee_id', $emp->id)->first();
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
                    $scores = $scores + $questionItem['point'];
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
                'sub_dept' => @$emp_dept ? @$emp_dept->department_id : 0, // công đoạn
                'cycle_name' => $cycle_name, // kỳ thi
                'create_date' => $request->ngaykiemtra, // ngày làm bài thi
                'results' => $results, // tổng số câu trả lời đúng
                'total_questions' => $totalQuestion, // tổng số câu hỏi
                'counting_time' => gmdate('i:s', $counting_time), // thời gian làm bài
                'limit_time' => '05:00', // tổng số câu hỏi
                'data' => json_encode($request->answer), // tổng số câu hỏi
                'status' => $scores > 79 ? 1 : 0, // 0:chưa duyệt,1:đã duyệt
                'mission' => $mission + 1, // số lần thi
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
            10142 => "Đàm Thị Hương",
            10352 => "Nguyễn Thị Kim Hoa",
            130206 => "Thịnh Thị Thái",
            130207 => "Ngô Thị Đậu",
            130323 => "Hoàng Thị Tình",
            130907 => "Nguyễn Thị Mỹ Hưởng",
            130947 => "Vũ Thị Yến",
            130976 => "Hoàng Thị Quyết",
            131102 => "Nguyễn Thị Anh",
            131107 => "Ngô Thị Hồng Nhung",
            131108 => "Phan Thị Loan",
            140204 => "Đinh Thị Trì",
            140303 => "Nguyễn Thị Lan",
            140322 => "Nguyễn Thị Lâm",
            140326 => "Trần Thị Thùy",
            140328 => "Lê Thị Hoa",
            140416 => "Dương Thị Dung",
            140519 => "Lâm Thị Thu Hằng",
            140787 => "Thân Thị Mai",
            1407100 => "Nguyễn Thị Minh Ngọc",
            1410119 => "Trần Thị Thu Thảo",
            141182 => "Phan Thị Loan",
            141197 => "Bùi Thị Nhâm",
            151106 => "Lưu Thị Phương",
            160417 => "Đoàn Thị Hạnh",
            160711 => "Hồ Thị Lê",
            160886 => "Nguyễn Minh Hòa",
            160933 => "Đặng Thị Hồng",
            1609182 => "Ngô Thị Huyền Trang",
            161125 => "Phùng Thị Thương",
            161176 => "Đinh Thị Nhã",
            1702134 => "Vũ Thị Như Quỳnh",
            170320 => "Nguyễn Thị Lý",
            170485 => "Vũ Thị Hương",
            170494 => "Lê Thị Kiền",
            170495 => "Ngô Thị Hiểu",
            170560 => "Bùi Trọng Doanh",
            170610 => "Đàm Văn Ninh",
            170648 => "Phùng Thị Phượng",
            170665 => "Lê Thị Yến",
            170751 => "Cao Thị Ánh Nguyệt",
            1707127 => "Trịnh Thị Thuần",
            170866 => "Đặng Khánh Linh",
            171002 => "Đinh Thị Hương",
            171050 => "Nguyễn Thị Tính",
            180371 => "Nguyễn Thị Hằng Nga",
            180393 => "Vi Thanh Sơn",
            1803145 => "Bùi Văn Anh",
            180817 => "Đinh Hoàng Giang",
            180823 => "Nguyễn Ngọc Ánh",
            180906 => "Võ Thị Hồng Nhung",
            181044 => "Nguyễn Văn Việt",
            181091 => "Nguyễn Thị Hợp",
            190457 => "Lê Thị Thúy Hồng",
            190529 => "Hoàng Thế Đạt",
            210301 => "Trần Thị Như Quỳnh",
            2103129 => "Nguyễn Văn Thanh",
            2103229 => "Vũ Thị Hằng",
            211059 => "Nguyễn Văn Tuấn",
            211068 => "Nguyễn Văn Tuân",
            220440 => "Lê Văn Chương",
            220454 => "Đoàn Đức Võ",
            2209109 => "Nguyễn Văn Tuyền",
            2211158 => "Nguyễn Thị Thuỳ",
            230209 => "Nguyễn Văn Nam",
            2302221 => "Lục Văn Châu",
            230317 => "Võ Văn Thật",
            230322 => "Đoàn Ngọc Oanh",
            230394 => "Phạm Văn Nam",
            2303152 => "Lê Đình Văn",
            230573 => "Lưu Thị Hương Ly",
            230867 => "Trần Thị Thảo",
            231164 => "Hoàng Thị Yên",
            231166 => "Đỗ Thị Nhung",
            231218 => "Nguyễn Văn Quân",
            240317 => "Nguyễn Thị Thúy",
            // 24031656 =>    "Nguyễn Thị Thúy 123",
            // 240341656 =>    "Nguyễn Thị Thúy 1235",
            240405 => "Nguyễn Thị Ngọc Lan",
            240406 => "Nguyễn Thị Thu",
            240407 => "Lê Thị Thanh Thủy",
            240408 => "Bùi Thị Lụa",
            240410 => "Lê Thị Thu Huyền",
            240411 => "Nguyễn Thị Trang",
            240412 => "Trương Thị Ánh",
            240415 => "Lê Ngọc Mai",
            240416 => "Nguyễn Phạm Tường Vy",
            240417 => "Đinh Thị Hằng",
            240424 => "Nguyễn Thị Nhiên",
            10006 =>    'Lê Thị Lý',
            10068 =>    'Nguyễn Thị Loan',
            10243 =>    'Hoàng Thị Quý',
            10269 =>    'Lê Thị Phương',
            10426 =>    'Vũ Thị Thảo',
            10444 =>    'Bùi Thị Duyên',
            130429 =>    'Đào Thị Tân ',
            130749 =>    'Lê Thị Lương',
            140361 =>    'Lê Thị Thoan',
            140507 =>    'Lý Thị Mai ',
            140526 =>    'Nguyễn Thị Lan',
            140612 =>    'Lê Thị Hồng Thu',
            140730 =>    'Nguyễn Thị Minh Luyến',
            140773 =>    'Nguyễn Thu Hoài',
            140932 =>    'Trần Thị Thu Thủy',
            1409102 =>    'Nguyễn Thị Phương',
            141069 =>    'Phạm Thị Mai',
            151237 =>    'Nguyễn Thị Kim Oanh',
            1606142 =>    'Đoàn Thị Thu Hà',
            160761 =>    'Nguyễn Thị Quỳnh',
            160902 =>    'Lê Thị Lan',
            160905 =>    'Đỗ Thị Thủy',
            160975 =>    'Lê Đức Hạnh',
            160979 =>    'Nguyễn Tuấn Dương',
            1609113 =>    'Lê Thị Phượng',
            1609122 =>    'Trần Thị Yến',
            1609160 =>    'Trương Thị Miền',
            161002 =>    'Ngô Thúy Hường',
            1703178 =>    'Nguyễn Thị Huyên',
            170644 =>    'Nguyễn Thị Phương',
            170714 =>    'Lưu Thị Thu Trang',
            170872 =>    'Nguyễn Thị Xuân',
            170916 =>    'Lại Thị Xuân',
            170933 =>    'Nguyễn Thị Vân',
            170953 =>    'Nguyễn Văn Hương',
            170955 =>    'Nguyễn Anh Sơn',
            171027 =>    'Đặng Thị Tâm',
            171215 =>    'Phạm Thị Hoa',
            180315 =>    'Hoàng Nhật Tuấn',
            180330 =>    'Hoàng Thị Hồng',
            180341 =>    'Đặng Thị Duyên',
            180377 =>    'Trần Thị Hòa',
            1803148 =>    'Lê Công Tý',
            180409 =>    'Bùi Thị Hoa',
            180429 =>    'Đinh Thị Vân Anh',
            180502 =>    'Ngô Thị Hương',
            180526 =>    'Nguyễn Thị Nga',
            180529 =>    'Ngô Thị Hồng Duyên',
            180573 =>    'Nguyễn Thu Vân',
            180602 =>    'Trịnh Thị Hà',
            180711 =>    'Lê Thị Luyến',
            181231 =>    'Nguyễn Thị Duyên',
            190320 =>    'Hà Thị Hằng',
            190354 =>    'Lê Như Đức',
            190364 =>    'Trương Mai Phương',
            190366 =>    'Ngô Thị Loan',
            190451 =>    'Nguyễn Thị Việt Trinh',
            191101 =>    'Trần Thanh Hương',
            191223 =>    'Trần Thị Hằng',
            200205 =>    'Phạm Thị Lan Anh',
            200906 =>    'Nguyễn Vân Anh',
            200910 =>    'Nguyễn Thị Thúy',
            200915 =>    'Nguyễn Thị Hường',
            200918 =>    'Nguyễn Thị Yến',
            200920 =>    'Phạm Thị Trang',
            201201 =>    'Kiều Thị Thúy Oanh',
            210317 =>    'Nguyễn Thị Thảo',
            210366 =>    'Ngô Thị Hoa',
            210369 =>    'Lỗ Thị Dư',
            2103133 =>    'Nguyễn Xuân Hòa',
            210431 =>    'Mào Thị Nhung',
            210432 =>    'Lò Thị Điểm',
            210444 =>    'Bùi Văn Hòe',
            210468 =>    'Dương Bích Nguyên',
            210480 =>    'Nguyễn Thị Hà',
            220226 =>    'Nguyễn Thị Nga',
            220306 =>    'Bùi Văn Hải',
            220339 =>    'Nguyễn Thị Hiền',
            220341 =>    'Hoàng Thị Huyền',
            220560 =>    'Nguyễn Trí Đăng',
            220626 =>    'Nguyễn Minh Tuyến',
            220634 =>    'Nguyễn Thị Tuyết',
            220637 =>    'Nguyễn Đình Phong',
            220715 =>    'Hà Thị Thùy',
            220753 =>    'Nguyễn Thị Thu Phương',
            220765 =>    'Nguyễn Thị Hương',
            220881 =>    'Nguyễn Thuỳ Dung',
            220988 =>    'Đặng Thị Chăng',
            220990 =>    'Trương Thị Mơ',
            221063 =>    'Bùi Văn Phương',
            221065 =>    'Nguyễn Thị Vân',
            221140 =>    'Vàng Thị Bích Thu',
            2211159 =>    'Nguyễn Văn Tiến',
            230201 =>    'Lò Thị Thinh',
            230231 =>    'Vương Thị Hồng Thanh',
            230290 =>    'Đặng Minh Tiến',
            230294 =>    'Hoàng Văn Nhất',
            2302112 =>    'Nguyễn Văn Thuyên',
            2302326 =>    'Bùi Thị Thành',
            230410 =>    'NguyễnThị Hằng',
            230411 =>    'Lê Thị Nhàn',
            230502 =>    'Phạm Thị Thu Hương',
            230503 =>    'Nguyễn Thu Thảo',
            230662 =>    'Lê Việt Anh',
            230865 =>    'Đỗ Thị Thu Hiền',
            230918 =>    'Trần Thị Trà My',
            231007 =>    'Nguyễn Quốc Trường Sơn',
            231016 =>    'Nguyễn Mạnh Hưng',
            231056 =>    'Hoàng Thị Biên',
            231057 =>    'Hoàng Thị Mỹ Lệ',
            231215 =>    'Trần Thị Ánh Ngọc',
            240207 =>    'Nguyễn Thị Hiển',
            240301 =>    'Hoàng Ngọc Ánh',
            240307 =>    'Hà Thị Kim Cúc',
            240409 =>    'Nguyễn Ngọc Lan',
            240414 =>    'Trần Thị An',
            240421 =>    'Bùi Thị Hương'
        ];

        foreach ($employee as $key => $value) {
            $emp = Employee::where('code', $key)->first();
            $parts = explode(" ", $value);
            if (count($parts) > 1) {
                $lastname = array_pop($parts);
                $firstname = implode(" ", $parts);
            } else {
                $firstname = $value;
                $lastname = " ";
            }
            if (!$emp) {

                $emp = Employee::create([
                    'code' => $key,
                    'first_name' => $firstname,
                    'last_name' => $lastname,
                    'created_by' => 1
                ]);
            }
            $emp->status_exam = 1;
            $emp->save();
            $admin =  Admin::where('username', $key)->first();
            if (!$admin) {
                //Tạo tài khoản
                $admin = Admin::create([
                    'first_name' => $firstname,
                    'last_name' => $lastname,
                    'username' =>  $key,
                    'email' => $key . 'exam@exam.com',
                    'password' => Hash::make($key),
                    'status' => 1,
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now()
                ]);
                // Assign Roles
                $admin->assignRole('Worker');
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
                'status' => $scores > 80 ? 1 : 0,
            ]);
        }
    }
    public function ImportEmpPostOld(Request $request)
    {
        set_time_limit(0);
        $data = Excel::toCollection(new EmpImport,  request()->file('import_file'));
        foreach ($data[0] as $key => $value) {
            if ($key > 0) {
                try {
                    $emp = Employee::where('code',  (int)trim($value[0]))->first();
                    $dept = Department::where('name',  $value[2])->first();
                    $emp_dept = EmployeeDepartment::where('employee_id',   $emp->id)->first();
                    if (!$dept) {
                        $dept = Department::create([
                            'code' => time(),
                            'name' => $value[2],
                            'parent_id' => 0,
                            'status' => 1,
                            'created_by' => 1,
                        ]);
                    }
                    if (!$emp) {

                        $parts = explode(" ", $value[1]);
                        if (count($parts) > 1) {
                            $lastname = array_pop($parts);
                            $firstname = implode(" ", $parts);
                        } else {
                            $firstname = $value;
                            $lastname = " ";
                        }
                        // Tạo nhân viên
                        $begin_date_company = explode("/", $value[5]);
                        $birthday = explode("/", $value[3]);
                        $employee = Employee::create([
                            'code' => (int)trim($value[0]),
                            'first_name' => $firstname,
                            'last_name' => $lastname,
                            'begin_date_company' => $begin_date_company[2] . '-' . $begin_date_company[1] . '-' . $begin_date_company[0],
                            'status' => 1,
                            'created_by' => 1,
                            'birthday' => $birthday[2] . '-' . $birthday[1] . '-' . $birthday[0],
                            'worker' => 3

                        ]); // Tạo một đối tượng Employee mới

                        EmployeeDepartment::create([
                            'employee_id' => $employee->id,
                            'department_id' => $dept->id,
                            'created_by' => 1,
                        ]);

                        //Tạo tài khoản
                        $admin = Admin::create([
                            'first_name' => $firstname,
                            'last_name' => $lastname,
                            'username' =>  $value[0],
                            'email' => $value[0] . 'exam@exam.com',
                            'password' => Hash::make($value[0]),
                            'status' => 1,
                            'created_at' => Carbon::now(),
                            'created_by' => 1,
                            'updated_at' => Carbon::now()
                        ]);
                        // Assign Roles
                        $admin->assignRole('Worker');
                    }
                    if (!$emp_dept) {
                        EmployeeDepartment::create([
                            'employee_id' => $emp->id,
                            'department_id' => $dept->id,
                            'created_by' => 1,
                        ]);
                    }
                    echo 'Thành công!';
                } catch (\Exception $e) {

                    echo $e->getMessage();
                    dd(1);
                }
            }
        }
    }
    public function ImportEmpPost(Request $request)
    {
        set_time_limit(0);
        $data = Excel::toCollection(new EmpImport,  request()->file('import_file'));
        foreach ($data[0] as $key => $value) {
            if ($key > 0) {
                try {
                    $emp = Employee::where('code',  (int)trim($value[0]))->first();
                    $dept = Department::where('name',  $value[2])->first();
                    $emp_dept = EmployeeDepartment::where('employee_id',   $emp->id)->first();
                    if (!$dept) {
                        $dept = Department::create([
                            'code' => time(),
                            'name' => $value[2],
                            'parent_id' => 0,
                            'status' => 1,
                            'created_by' => 1,
                        ]);
                    }
                    if (!$emp_dept) {
                        EmployeeDepartment::create([
                            'employee_id' => $emp->id,
                            'department_id' => $dept->id,
                            'created_by' => 1,
                        ]);
                    }
                    echo 'Thành công!';
                } catch (\Exception $e) {

                    echo $e->getMessage();
                    dd(1);
                }
            }
        }
    }

    public function updateCreateDate()
    {
        $fdgfdgf = Employee::all();
        foreach ($fdgfdgf as $key => $value) {

            $fdgf = Exam::select('id')->where('code', $value->code)
                ->where('cycle_name', 42024)
                ->where('examinations', 1)
                ->where('status', 1)
                ->groupBy('code')->count();
            echo $fdgf . '============</br>';
            if ($fdgf > 1) {
                $fdgf345 = Exam::select('code', DB::raw('MAX(id) as _id'))->where('code', $value->code)
                    ->where('cycle_name', 42024)
                    ->where('examinations', 1)
                    ->where('status', 1)
                    ->groupBy('code')
                    ->first();
                $fdgdfg = Exam::find($fdgf345->_id);
                $fdgdfg->update([
                    'examinations' => 2,
                    'create_date' => '2024-04-19',
                    'mission' => 1, // số lần thi
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
                'mission' => $mission,
            ]);
        }
    }
    public function updateCode()
    {
        $fdgfdgf = Exam::all();
        $employee = [
            10142 => "Đàm Thị Hương",
            10352 => "Nguyễn Thị Kim Hoa",
            130206 => "Thịnh Thị Thái",
            130207 => "Ngô Thị Đậu",
            130323 => "Hoàng Thị Tình",
            130907 => "Nguyễn Thị Mỹ Hưởng",
            130947 => "Vũ Thị Yến",
            130976 => "Hoàng Thị Quyết",
            131102 => "Nguyễn Thị Anh",
            131107 => "Ngô Thị Hồng Nhung",
            131108 => "Phan Thị Loan",
            140204 => "Đinh Thị Trì",
            140303 => "Nguyễn Thị Lan",
            140322 => "Nguyễn Thị Lâm",
            140326 => "Trần Thị Thùy",
            140328 => "Lê Thị Hoa",
            140416 => "Dương Thị Dung",
            140519 => "Lâm Thị Thu Hằng",
            140787 => "Thân Thị Mai",
            1407100 => "Nguyễn Thị Minh Ngọc",
            1410119 => "Trần Thị Thu Thảo",
            141182 => "Phan Thị Loan",
            141197 => "Bùi Thị Nhâm",
            151106 => "Lưu Thị Phương",
            160417 => "Đoàn Thị Hạnh",
            160711 => "Hồ Thị Lê",
            160886 => "Nguyễn Minh Hòa",
            160933 => "Đặng Thị Hồng",
            1609182 => "Ngô Thị Huyền Trang",
            161125 => "Phùng Thị Thương",
            161176 => "Đinh Thị Nhã",
            1702134 => "Vũ Thị Như Quỳnh",
            170320 => "Nguyễn Thị Lý",
            170485 => "Vũ Thị Hương",
            170494 => "Lê Thị Kiền",
            170495 => "Ngô Thị Hiểu",
            170560 => "Bùi Trọng Doanh",
            170610 => "Đàm Văn Ninh",
            170648 => "Phùng Thị Phượng",
            170665 => "Lê Thị Yến",
            170751 => "Cao Thị Ánh Nguyệt",
            1707127 => "Trịnh Thị Thuần",
            170866 => "Đặng Khánh Linh",
            171002 => "Đinh Thị Hương",
            171050 => "Nguyễn Thị Tính",
            180371 => "Nguyễn Thị Hằng Nga",
            180393 => "Vi Thanh Sơn",
            1803145 => "Bùi Văn Anh",
            180817 => "Đinh Hoàng Giang",
            180823 => "Nguyễn Ngọc Ánh",
            180906 => "Võ Thị Hồng Nhung",
            181044 => "Nguyễn Văn Việt",
            181091 => "Nguyễn Thị Hợp",
            190457 => "Lê Thị Thúy Hồng",
            190529 => "Hoàng Thế Đạt",
            210301 => "Trần Thị Như Quỳnh",
            2103129 => "Nguyễn Văn Thanh",
            2103229 => "Vũ Thị Hằng",
            211059 => "Nguyễn Văn Tuấn",
            211068 => "Nguyễn Văn Tuân",
            220440 => "Lê Văn Chương",
            220454 => "Đoàn Đức Võ",
            2209109 => "Nguyễn Văn Tuyền",
            2211158 => "Nguyễn Thị Thuỳ",
            230209 => "Nguyễn Văn Nam",
            2302221 => "Lục Văn Châu",
            230317 => "Võ Văn Thật",
            230322 => "Đoàn Ngọc Oanh",
            230394 => "Phạm Văn Nam",
            2303152 => "Lê Đình Văn",
            230573 => "Lưu Thị Hương Ly",
            230867 => "Trần Thị Thảo",
            231164 => "Hoàng Thị Yên",
            231166 => "Đỗ Thị Nhung",
            231218 => "Nguyễn Văn Quân",
            240317 => "Nguyễn Thị Thúy",
        ];
        foreach ($fdgfdgf as $key => $value) {
            foreach ($employee as $key1 => $value1) {
                if ($value1 == $value->name) {
                    $value->update([
                        'code' => $key1,
                    ]);
                }
            }
        }
    }
    public function updateBeginDate()
    {
        $fdgfdgf = Employee::all();
        $employee = [
            240317 => "11/3/2024",
            240405 => "16/4/2024",
            240406 => "16/4/2024",
            240407 => "16/4/2024",
            240408 => "16/4/2024",
            240410 => "22/4/2024",
            240411 => "22/4/2024",
            240412 => "22/4/2024",
            240415 => "22/4/2024",
            240416 => "22/4/2024",
            240417 => "22/4/2024",
            240424 => "22/4/2024",
        ];
        foreach ($fdgfdgf as $key => $value) {
            foreach ($employee as $key1 => $value1) {
                if ($key1 == $value->code) {
                    $beginDate = Carbon::createFromFormat('d/m/Y', $value1);
                    $value->update([
                        'begin_date_company' => $beginDate->format('Y-m-d'),
                    ]);
                }
            }
        }
    }
}
