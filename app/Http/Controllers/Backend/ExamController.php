<?php

namespace App\Http\Controllers\Backend;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
    public function index($isTrashed = false)
    {

        if (is_null($this->user) || !$this->user->can('exam.view')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        if (request()->ajax()) {
            if ($isTrashed) {
                $exams = Exam::orderBy('id', 'desc')
                    ->get();
            } else {
                $exams = Exam::orderBy('id', 'desc')
                    ->where('deleted_at', null)
                    ->get();
            }
            $datatable = DataTables::of($exams, $isTrashed)
                ->addIndexColumn()
                ->addColumn(
                    'action',
                    function ($row) use ($isTrashed) {
                        $csrf = "" . csrf_field() . "";
                        $method_delete = "" . method_field("delete") . "";
                        $method_put = "" . method_field("put") . "";
                        $html = '';

                        if ($row->deleted_at === null) {
                            $deleteRoute =  route('admin.exams.destroy', [$row->id]);
                            // if ($this->user->can('exam.edit')) {
                            //     $html .= '<a class="btn waves-effect waves-light btn-success btn-sm btn-circle ml-1 " title="Edit exam Details" href="' . route('admin.exams.edit', $row->id) . '"><i class="fa fa-edit"></i></a>';
                            // }
                            if ($this->user->can('exam.delete')) {
                                $html .= '<a class="btn waves-effect waves-light btn-danger btn-sm btn-circle ml-1 text-white" title="Delete Admin" id="deleteItem' . $row->id . '"><i class="fa fa-trash"></i></a>';
                            }
                        } else {
                            if ($this->user->can('exam.delete')) {
                                $deleteRoute =  route('admin.exams.trashed.destroy', [$row->id]);
                                $revertRoute = route('admin.exams.trashed.revert', [$row->id]);

                                $html .= '<a class="btn waves-effect waves-light btn-warning btn-sm btn-circle ml-1" title="Revert Back" id="revertItem' . $row->id . '"><i class="fa fa-check"></i></a>';
                                $html .= '
                                <form id="revertForm' . $row->id . '" action="' . $revertRoute . '" method="post" style="display:none">' . $csrf . $method_put . '
                                    <button type="submit" class="btn waves-effect waves-light btn-rounded btn-success"><i
                                            class="fa fa-check"></i> Confirm Revert</button>
                                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal"><i
                                            class="fa fa-times"></i> Cancel</button>
                                </form>';
                                $html .= '<a class="btn waves-effect waves-light btn-danger btn-sm btn-circle ml-1 text-white" title="Delete exam Permanently" id="deleteItemPermanent' . $row->id . '"><i class="fa fa-trash"></i></a>';
                            }
                        }

                        if ($this->user->can('exam.delete')) {
                            $html .= '<script>
                            $("#deleteItem' . $row->id . '").click(function(){
                                swal.fire({ title: "Are you sure?",text: "exam will be deleted as trashed !",type: "warning",showCancelButton: true,confirmButtonColor: "#DD6B55",confirmButtonText: "Yes, delete it!"
                                }).then((result) => { if (result.value) {$("#deleteForm' . $row->id . '").submit();}})
                            });
                        </script>';

                            $html .= '<script>
                            $("#deleteItemPermanent' . $row->id . '").click(function(){
                                swal.fire({ title: "Are you sure?",text: "exam will be deleted permanently, both from trash !",type: "warning",showCancelButton: true,confirmButtonColor: "#DD6B55",confirmButtonText: "Yes, delete it!"
                                }).then((result) => { if (result.value) {$("#deletePermanentForm' . $row->id . '").submit();}})
                            });
                        </script>';

                            $html .= '<script>
                            $("#revertItem' . $row->id . '").click(function(){
                                swal.fire({ title: "Are you sure?",text: "exam will be revert back from trash !",type: "warning",showCancelButton: true,confirmButtonColor: "#DD6B55",confirmButtonText: "Yes, Revert Back!"
                                }).then((result) => { if (result.value) {$("#revertForm' . $row->id . '").submit();}})
                            });
                        </script>';

                            $html .= '
                            <form id="deleteForm' . $row->id . '" action="' . $deleteRoute . '" method="post" style="display:none">' . $csrf . $method_delete . '
                                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-success"><i
                                        class="fa fa-check"></i> Confirm Delete</button>
                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal"><i
                                        class="fa fa-times"></i> Cancel</button>
                            </form>';

                            $html .= '
                            <form id="deletePermanentForm' . $row->id . '" action="' . $deleteRoute . '" method="post" style="display:none">' . $csrf . $method_delete . '
                                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-success"><i
                                        class="fa fa-check"></i> Confirm Permanent Delete</button>
                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal"><i
                                        class="fa fa-times"></i> Cancel</button>
                            </form>';
                        }
                        return $html;
                    }
                )

                ->editColumn('name', function ($row) {
                    return $row->name;
                })
                ->editColumn('code', function ($row) {
                    return $row->code;
                })
                ->editColumn('sub_dept', function ($row) {
                    if ($row->sub_dept == 1) {
                        return 'Cắm';
                    }  else {
                        return '---';
                    }
                })
                ->editColumn('cycle_name', function ($row) {
                    return $row->cycle_name;
                })
                ->editColumn('create_date', function ($row) {
                    return $row->create_date;
                })
                ->editColumn('total_questions', function ($row) {
                    return $row->total_questions;
                })
                ->editColumn('marks', function ($row) {
                    return round(($row->results/$row->total_questions)*100);
                })
                ->editColumn('confirm', function ($row) {
                    return $row->confirm;
                })
                ->editColumn('counting_time', function ($row) {
                    return $row->counting_time;
                })
                ->editColumn('limit_time', function ($row) {
                    return $row->limit_time;
                })
                ->editColumn('status', function ($row) {
                    if ($row->status) {
                        return '<span class="badge badge-success font-weight-100">Đã duyệt</span>';
                    } else if ($row->deleted_at != null) {
                        return '<span class="badge badge-danger">Trashed</span>';
                    } else {
                        return '<span class="badge badge-warning">Chờ duyệt</span>';
                    }
                });
            $rawColumns = [
                'name',
                'code',
                'sub_dept',
                'cycle_name',
                'create_date',
                'results',
                'total_questions',
                'marks',
                'status',
                'confirm',
                'counting_time',
                'limit_time',
                'action'
            ];
            return $datatable->rawColumns($rawColumns)
                ->make(true);
        }
        $count_exams = count(Exam::select('id')->get());
        $count_active_exams = count(Exam::select('id')->where('status', 1)->get());
        $count_trashed_exams = count(Exam::select('id')->where('deleted_at', '!=', null)->get());
        return view('backend.pages.exams.index', compact('count_exams', 'count_active_exams', 'count_trashed_exams'));
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

        session()->flash('success', 'exam has been deleted successfully as trashed !!');
        return redirect()->route('admin.exams.index');
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

        session()->flash('success', 'exam has been deleted permanently !!');
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
        }
        return $this->index(true);
    }
}
