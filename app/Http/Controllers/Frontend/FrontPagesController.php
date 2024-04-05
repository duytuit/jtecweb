<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
    public function exam()
    {
        return view('frontend.pages.exam');
    }
    public function test()
    {
        $fruits = ArrayHelper::arrayExamPd();
        shuffle($fruits);
        dd($fruits);
    }
    public function test1()
    {

        //dd($fruits);
        // mảng cần tìm
        //$key=array_search("R", array_column(json_decode(json_encode($fruits),TRUE), 'answer'));
        //dd($fruits[$key]);
        //unset($fruits[$key]);
        //$firstThreeElements = array_slice($fruits, 0, 3);
        // dd($firstThreeElements);

        // hàm đảo đáp án
        $fruits = ArrayHelper::arrayExamPd();
        $arrayFiltered = array_filter($fruits, fn($element) => $element['answer'] == "R");
       // $array_answer = array_column($fruits, 'answer');
        // $arrayFiltered = array_filter($array_answer, fn($element) => $element != "R");
        // $firstThreeElements = array_slice($arrayFiltered, 0, 3);
        // array_push($firstThreeElements, "R");
        // shuffle($firstThreeElements);
        dd(count($arrayFiltered));
    }
    public function store(Request $request)
    {
       //dd($request->exists('answer'));
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
        try {
            $exam = Exam::create([
                'name' => $request->hovaten, //tên nhân viên
                'code' => $request->manhanvien, // mã nhân viên
                'sub_dept' => $request->congdoan, // công đoạn
                'cycle_name' => Carbon::parse($request->ngaykiemtra)->format('mY'), // kỳ thi
                'create_date' => $request->ngaykiemtra, // ngày làm bài thi
                'results' => $results,// tổng số câu trả lời đúng
                'total_questions' => count($arrayExam),// tổng số câu hỏi
                'status' =>  0,// 0:chưa duyệt,1:đã duyệt
            ]);
            return $this->success(compact('exam'));
        } catch (\Exception $e) {
            return $this->error(['error', $e->getMessage()]);
        }
    }

}
