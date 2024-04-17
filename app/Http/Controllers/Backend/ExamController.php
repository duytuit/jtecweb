<?php

namespace App\Http\Controllers\Backend;

use App\Exports\ExamExport;
use App\Helpers\ArrayHelper;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToArray;
use Yajra\DataTables\Facades\DataTables;

class ExamController extends Controller
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

        if (is_null($this->user) || !$this->user->can('exam.view')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        // Phân trang
        $data['per_page'] = $request->input('per_page', Cookie::get('per_page'));
        $data['keyword'] = $request->input('keyword', null);
        $data['advance'] = 0;
        if (count($request->except('keyword')) > 0) {
           // Tìm kiếm nâng cao
           $data['advance'] = 1;
           $data['filter'] = $request->all();
        }
        $current_cycleName = Carbon::now()->format('mY');
        $data['cycleName'] = $current_cycleName;
        $data['cycleNames'] = ArrayHelper::cycleName();
        $data['emp'] = Employee::select('code')->pluck('code');
        $data['emp_pass_1'] = Exam::select('code',DB::raw('MIN(created_at) as min_created_at'))
                                    ->whereIn('code',$data['emp'])
                                    ->where('cycle_name',$current_cycleName)
                                    ->where('status',1)->groupBy('code')->get()->ToArray();
        $code_emp_pass_1 = array_column($data['emp_pass_1'],'code');
        $created_at_emp_pass_1 = array_column($data['emp_pass_1'],'min_created_at');
        $data['emp_fail_1_90_95'] = Exam::select('code',DB::raw('MIN(created_at) as min_created_at'))
                                    ->whereIn('code',$data['emp'])
                                    ->where('cycle_name',$current_cycleName)
                                    ->whereNotIn('created_at',$created_at_emp_pass_1)
                                    ->whereNotIn('code',$code_emp_pass_1)
                                    ->where('status',0)->where('scores','>=',90)->where('scores','<=',95)->groupBy('code')->get()->ToArray();
        $data['emp_fail_1_90'] = Exam::select('code',DB::raw('MIN(created_at) as min_created_at'))
                                    ->whereIn('code',$data['emp'])
                                    ->where('cycle_name',$current_cycleName)
                                    ->whereNotIn('created_at',$created_at_emp_pass_1)
                                    ->whereNotIn('code',$code_emp_pass_1)
                                    ->whereNotIn('code',array_column($data['emp_fail_1_90_95'],'code'))
                                    ->where('status',0)->where('scores','<',90)->groupBy('code')->get()->ToArray();
        $data['emp_yet_1'] = Employee::select('code')
                                    ->whereNotIn('code',$code_emp_pass_1)
                                    ->whereNotIn('code',array_column($data['emp_fail_1_90_95'],'code'))->whereNotIn('code',array_column($data['emp_fail_1_90'],'code'))->get()->ToArray();
        $data['emp_pass_2'] = Exam::select('code',DB::raw('MAX(created_at) as max_created_at'))
                                    ->whereIn('code',$data['emp'])
                                    ->where('cycle_name',$current_cycleName)
                                    ->whereNotIn('created_at',$created_at_emp_pass_1)
                                    ->where('status',1)->groupBy('code')->get()->ToArray();
        $code_emp_pass_2 = array_column($data['emp_pass_2'],'code');
        $data['emp_fail_2_90_95'] = Exam::select('code',DB::raw('MAX(created_at) as max_created_at'))
                                    ->whereIn('code',$data['emp'])
                                    ->where('cycle_name',$current_cycleName)
                                    ->whereNotIn('created_at',$created_at_emp_pass_1)
                                    ->whereNotIn('created_at',array_column($data['emp_pass_2'],'max_created_at'))
                                    ->whereNotIn('code',$code_emp_pass_2)
                                    ->where('status',0)->where('scores','>=',90)->where('scores','<=',95)->groupBy('code')->get()->ToArray();
        $data['emp_fail_2_90'] = Exam::select('code',DB::raw('MAX(created_at) as max_created_at'))
                                    ->whereIn('code',$data['emp'])
                                    ->where('cycle_name',$current_cycleName)
                                    ->whereNotIn('created_at',$created_at_emp_pass_1)
                                    ->whereNotIn('created_at',array_column($data['emp_pass_2'],'max_created_at'))
                                    ->whereNotIn('code',$code_emp_pass_2)
                                    ->whereNotIn('code',array_column($data['emp_fail_2_90_95'],'code'))
                                    ->where('status',0)->where('scores','<',90)->groupBy('code')->get()->ToArray();
        $data['emp_yet_2'] = Employee::select('code')
                                    ->whereNotIn('code',$code_emp_pass_2)
                                    ->whereNotIn('code',array_column($data['emp_fail_2_90_95'],'code'))->whereNotIn('code',array_column($data['emp_fail_2_90'],'code'))->get()->ToArray();

        $data['lists'] = Exam::where( function($query) use($request){
            if (isset($request->keyword) && $request->keyword != null) {
                $query->filter($request);
            }
            if (isset($request->cycle_name) && $request->cycle_name != null) {
                $query->where('cycle_name', $request->cycle_name);
            }
            if(isset($request->status) && $request->status != null){
                $query->where('status', $request->status);
            }
            if (isset($request->from_date) && isset($request->to_date)) {
                $from_date = Carbon::parse($request->from_date)->format('Y-m-d');
                $to_date   = Carbon::parse($request->to_date)->format('Y-m-d');
                $query->whereDate('create_date', '>=', $from_date);
                $query->whereDate('create_date', '<=', $to_date);
            }
        })->orderBy('code')->orderBy('cycle_name')->orderBy('created_at')->paginate($data['per_page']);
        return view('backend.pages.exams.index',$data);
    }
    public function exportExcel(Request $request)
    {
        $data = Exam::where( function($query) use($request){
            if (isset($request->keyword) && $request->keyword != null) {
                $query->filter($request);
            }
            if (isset($request->cycle_name) && $request->cycle_name != null) {
                $query->where('cycle_name', $request->cycle_name);
            }
            if(isset($request->status) && $request->status != null){
                $query->where('status', $request->status);
            }
            if (isset($request->from_date) && isset($request->to_date)) {
                $from_date = Carbon::parse($request->from_date)->format('Y-m-d');
                $to_date   = Carbon::parse($request->to_date)->format('Y-m-d');
                $query->whereDate('create_date', '>=', $from_date);
                $query->whereDate('create_date', '<=', $to_date);
            }
        })->orderBy('code')->orderBy('cycle_name')->orderBy('created_at')->get();
       return (new ExamExport($data))->download('exam.xlsx');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('exam.delete')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $exam = Exam::find($id);
        if (is_null($exam)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('admin.exams.index');
        }
        $exam->deleted_at = Carbon::now();
        $exam->deleted_by = Auth::id();
        $exam->status = 0;
        $exam->save();

        session()->flash('success', 'Đã xóa bản ghi thành công !!');
        return redirect()->route('admin.exams.index');
    }
 /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = Exam::where( function($query) use($request){
            if (isset($request->keyword) && $request->keyword != null) {
                $query->filter($request);
            }
            if (isset($request->cycle_name) && $request->cycle_name != null) {
                $query->where('cycle_name', $request->cycle_name);
            }
            if(isset($request->status) && $request->status != null){
                $query->where('status', $request->status);
            }
            if (isset($request->from_date) && isset($request->to_date)) {
                $from_date = Carbon::parse($request->from_date)->format('Y-m-d');
                $to_date   = Carbon::parse($request->to_date)->format('Y-m-d');
                $query->whereDate('create_date', '>=', $from_date);
                $query->whereDate('create_date', '<=', $to_date);
            }
        })->orderBy('code')->orderBy('cycle_name')->orderBy('created_at')->get();
       return (new ExamExport($data))->download('exam.xlsx');
    }
    /**
     * revertFromTrash
     *
     * @param integer $id
     * @return Remove the item from trash to active -> make deleted_at = null
     */
    public function revertFromTrash($id)
    {
        if (is_null($this->user) || !$this->user->can('exam.delete')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $exam = Exam::find($id);
        if (is_null($exam)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('admin.exams.index');
        }
        $exam->deleted_at = null;
        $exam->deleted_by = null;
        $exam->save();

        session()->flash('success', 'exam has been revert back successfully !!');
        return redirect()->route('admin.exams.index');
    }

    /**
     * destroyTrash
     *
     * @param integer $id
     * @return void Destroy the data permanently
     */
    public function destroyTrash($id)
    {
        if (is_null($this->user) || !$this->user->can('exam.delete')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $exam = Exam::find($id);
        if (is_null($exam)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('admin.exams.index');
        }

        // Delete exam permanently
        $exam->delete();

        session()->flash('success', 'Bản ghi đã được xóa!!');
        return redirect()->route('admin.exams.index');
    }

    /**
     * trashed
     *
     * @return view the trashed data list -> which data status = 0 and deleted_at != null
     */
    public function trashed()
    {
        if (is_null($this->user) || !$this->user->can('exam.view')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }return 1;
    }
    public function action(Request $request)
    {
        $method = $request->input('method','');
        if ($method == 'per_page') {
            $this->per_page($request);
            return back();
        }else if($method == 'restore_apartment') {
            return back()->with('success', 'thành công!');
        }else if($method == 'delete') {
            if(isset($request->ids)){
               $count_record = Exam::whereIn('id',$request->ids)->delete();
            }
            return back()->with('success','đã xóa '.$count_record.' bản ghi');
        }else{
            return back()->with('success', 'thành công!');
        }

    }
}
