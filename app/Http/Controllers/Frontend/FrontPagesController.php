<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
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
        $array_answer = array_column($fruits, 'answer');
        $arrayFiltered = array_filter($array_answer, fn($element) => $element != "R");
        $firstThreeElements = array_slice($arrayFiltered, 0, 3);
        array_push($firstThreeElements, "R");
        shuffle($firstThreeElements);
        dd($firstThreeElements);
    }
    public function store(Request $request)
    {
        dd($request);
    }

}
