<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DepartmentImport;
use App\Exports\DepartmentExport;



class DepartmentController extends Controller
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
        if (is_null($this->user) || !$this->user->can('department.view')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        // Phân trang
        $department['per_page'] = $request->input('per_page', Cookie::get('per_page'));
        $department['keyword'] = $request->input('keyword', null);
        $department['advance'] = 0;
        if (count($request->except('keyword')) > 0) {
            // Tìm kiếm nâng cao
            $department['advance'] = 1;
            $department['filter'] = $request->all();
        }

        $department['lists'] = Department::where(function ($query) use ($request) {
            if (isset($request->keyword) && $request->keyword != null) {
                $query->filter($request);
            }
            if (isset($request->status) && $request->status != null) {
                $query->where('status', $request->status);
            }
        })->paginate($department['per_page']);
        //dd($department['lists']);
        return view('backend.pages.departments.index', $department);
    }
    // public function importIndex()
    // {
    //     $department = Department::all();
    //     return view('admin.departments.index', compact('department'));
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('department.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        return view('backend.pages.departments.create');
    }

    public function importExcelData(Request $request)
    {
        $request->validate([
            'import_file' => [
                'required',
                'file',
            ],
        ]);
        Excel::import(new DepartmentImport, $request->file('import_file'));
        // return redirect('/')->with('success', 'All good!');
        return redirect()->back()->with('status', 'Import thành công');
        // return view('backend.pages.departments.import')->with('status', 'Import thành công');
        // session()->flash('success', 'Thêm mới thành công');
        // return redirect()->route('admin.departments.index');
    }
    public function exportExcel(Request $request)
    {
        $data = Department::where(function ($query) use ($request) {
            if (isset($request->keyword) && $request->keyword != null) {
                $query->filter($request);
            }
            if (isset($request->status) && $request->status != null) {
                $query->where('status', $request->status);
            }
        })->orderBy('code')->get();
        return (new DepartmentExport($data))->download('Department-export.xlsx');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'departments_code' => 'required',
            'departments_title' => 'required',
        ]);
        try {
            $department = Department::create([
                'code' => $request->departments_code,
                'name' => $request->departments_title,
                'parent_id' => 0,
                'status' => @$request->status ? 1 : 0,
                'created_by' => Auth::user()->id,
            ]);
            session()->flash('success', 'Thêm mới thành công');
            return redirect()->route('admin.departments.index');
        } catch (\Exception $e) {
            return $this->error(['error', $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_null($this->user) || !$this->user->can('departments.view')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $department = Department::find($id);
        return view('backend.pages.departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('department.edit')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $department = Department::find($id);
        return view('backend.pages.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $department = Department::find($id);

        if (empty($department)) {
            session()->flash('error', "The page is not found.");
            return redirect()->route('admin.departments.index');
        }

        // Update department
        try {
            $department->name = $request->input('departments_title');
            $department->code = $request->input('departments_code');
            $department->save();

            session()->flash('success', "Department updated successfully.");
            return redirect()->route('admin.departments.index');
        } catch (\Exception $e) {
            session()->flash('error', "Failed to update department: " . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroyTrash($id)
    {
        $department = Department::find($id);
        if (is_null($department)) {
            session()->flash('error', "Nội dung đã được xóa hoặc không tồn tại !");
            return redirect()->route('admin.department.index');
        }
        $department->deleted_at = Carbon::now();
        $department->deleted_by = Auth::id();
        $department->status = 0;
        $department->save();
        $department->delete();
        session()->flash('success', 'Đã xóa bản ghi thành công !!');
        return redirect()->route('admin.departments.index');
    }
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('department.delete')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $department = Department::find($id);
        if (is_null($department)) {
            session()->flash('error', "Nội dung đã được xóa hoặc không tồn tại !");
            return redirect()->route('admin.department.index');
        }
        $department->deleted_at = Carbon::now();
        $department->deleted_by = Auth::id();
        $department->status = 0;
        $department->save();

        session()->flash('success', 'Đã xóa bản ghi thành công !!');
        return redirect()->route('admin.department.index');
    }
    public function action(Request $request)
    {
        $method = $request->input('method', '');
        if ($method == 'per_page') {
            $this->per_page($request);
            return back();
        } else if ($method == 'restore_apartment') {
            return back()->with('success', 'thành công!');
        } else if ($method == 'delete') {
            if (isset($request->ids)) {
                foreach ($request->ids as $key => $value) {
                    $count_record = Department::find($value)->delete();
                }
            }
            return back()->with('success', 'đã xóa ' . count($request->ids) . ' bản ghi');
        } else {
            return back()->with('success', 'thành công!');
        }
    }
}
