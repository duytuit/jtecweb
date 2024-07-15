<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ActivityController extends Controller
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
        // Phân trang
        $data['per_page'] = $request->input('per_page', Cookie::get('per_page'));
        $data['keyword'] = $request->input('keyword', null);
        $data['advance'] = 0;
        if (count($request->except('keyword')) > 0) {
            // Tìm kiếm nâng cao
            $data['advance'] = 1;
            $data['filter'] = $request->all();
        }
        $data['models'] = ArrayHelper::getModels();
        $data['lists'] = Activity::where(function ($query) use ($request) {
            if (isset($request->keyword) && $request->keyword != null) {
                $query->filter($request);
            }
            if (isset($request->modelId) && $request->modelId != null) {
                $query->where('content_id', $request->modelId);
            }
            if (isset($request->content_type) && $request->content_type != null) {
                $query->where('content_type', $request->content_type);
            }
        })->orderBy('id','desc')->paginate($data['per_page']);
        return view('backend.pages.activitys.index', $data);
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

        $exam = Activity::find($id);
        if (is_null($exam)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('admin.activitys.index');
        }
        $exam->deleted_at = Carbon::now();
        $exam->deleted_by = Activity::id();
        $exam->status = 0;
        $exam->save();

        session()->flash('success', 'Đã xóa bản ghi thành công !!');
        return redirect()->route('admin.activitys.index');
    }
     /**
     * destroyTrash
     *
     * @param integer $id
     * @return void Destroy the data permanently
     */
    public function destroyTrash($id)
    {
        if (is_null($this->user) || !$this->user->can('activity.delete')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $exam = Activity::find($id);
        if (is_null($exam)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('admin.activitys.index');
        }

        // Delete exam permanently
        $exam->delete();

        session()->flash('success', 'Bản ghi đã được xóa!!');
        return redirect()->route('admin.activitys.index');
    }
}
