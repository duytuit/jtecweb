@extends('backend.layouts.master')
@php
    use App\Models\Employee;
    use App\Models\Department;

@endphp
{{-- @section('title')
    @include('backend.pages.requireds.partials.title')
@endsection --}}

@section('admin-content')
    @include('backend.pages.requireds.partials.header-breadcrumbs')
    <div class="container-fluid">
        <form id="form-search" action="{{ route('admin.requireds.index') }}" method="get">
            @csrf
            <div class="row form-group">
                <div class="col-sm-8">
                    <span class="btn-group">
                        <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Tác vụ <span
                                class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a class="btn-action" data-target="#form_lists" data-method="delete" href="javascript:;"><i
                                        class="fa fa-trash" style="color: #cb3030;"></i> Xóa</a></li>
                            <li><a class="btn-action" data-target="#form_lists" data-method="active_check"
                                    href="javascript:;"><i class="fa fa-check-circle" style="color: #3800df;"></i> Duyệt</a>
                            </li>
                            <li><a class="btn-action" data-target="#form_lists" data-method="inactive_check"
                                    href="javascript:;"><i class="fa fa-check-circle" style="color: #3800df;"></i> Bỏ
                                    duyệt</a></li>
                        </ul>
                    </span>
                    {{-- <a href="{{ route('admin.requireds.index') }}" class="btn btn-info"><i class="fa fa-edit"></i> Thêm
                        mới</a>
                 <span class="btn-group">
                        <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Thêm từ Excel
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu import-excel">
                            <li>
                                <form action="{{ route('admin.checkCutMachine.importExcelData') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group">
                                        <input type="file" name="import_file" class="form-control" placeholder=" ">
                                        <button type="submit" class="btn btn-primary" name="upload"><i
                                                class="fa fa-import"></i>Nhập</button>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </span>
                    <a href="{{ route('admin.checkCutMachine.exportExcel', Request::all()) }}" class="btn btn-success"><i
                            class="fa fa-edit"></i> Xuất Excel</a> --}}
                </div>
                <div class="col-sm-4 text-right">
                    <div class="input-group">
                        <input type="text" name="keyword" value="{{ $keyword }}" placeholder="Nhập từ khóa"
                            class="form-control" />
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                            <button type="button" class="btn btn-warning btn-search-advance" data-toggle="show"
                                data-target=".search-advance"><span class="fa fa-filter"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- END #form-search -->

        <!-- START #form-search-advance -->
        <form id="form-search-advance" action="{{ route('admin.requireds.index') }}" method="get" class="hidden">
            <div id="search-advance" class="search-advance">
                <div class="row form-group space-5">
                    <div class="col-sm-2">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"> <i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="text" class="form-control date_picker datepicker" name="from_date"
                                id="from_date" value="{{ @$filter['from_date'] }}" placeholder="Từ..." autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"> <i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="text" class="form-control date_picker datepicker" name="to_date" id="to_date"
                                value="{{ @$filter['to_date'] }}" placeholder="Đến..." autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-warning btn-block">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- END #form-search-advance -->
        <form id="form_lists" action="{{ route('admin.requireds.action') }}" method="post">
            @csrf
            <input type="hidden" name="method" value="" />
            <div class="table-responsive product-table overflow-x-scroll ">
                <table class="table table-bordered" id="checkCutMachine_table" style="min-width: 1280px; ">
                    <thead>
                        <tr>
                            <th width="3%"><input type="checkbox" class="greyCheck checkAll"
                                    data-target=".checkSingle" /></th>
                            <th>TT</th>
                            <th>Mã yêu cầu <br>Ngày yêu cầu</th>
                            <th>Thông tin yêu cầu</th>
                            <th>Bộ phận yêu cầu</th>
                            <th>Bộ phận tiếp nhận</th>
                            <th>Trạng thái</th>
                            <th>Ghi chú</th>
                            <th>Người thực hiện</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lists as $index => $item)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{ $item->id }}"
                                        class="greyCheck checkSingle" /></td>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->code_required }} <br>
                                    {{ $item->created_at }}
                                </td>
                                <td>
                                    {{ 'Mã linh kiện: ' . @$item->code }} <br>
                                    {{ 'Số lượng: ' . @$item->quantity }} <br>
                                    {{ 'Định lượng: ' . @$item->size }} <br>
                                    {{ 'Đơn vị: ' . @$item->unit_price }} <br>
                                    {{-- {{'Vị trí: '.@$item->}} <br> --}}
                                    {{ 'Người yêu cầu: ' . @$item->employee->first_name . ' ' . @$item->employee->last_name }}
                                </td>
                                <td>{{ @$item->employeeDepartment->department->name }}</td>
                                <td>
                                    @php
                                        $department_ids = json_decode($item->receiving_department_ids, true);
                                    @endphp
                                    @foreach ($department_ids as $department_id)
                                        @php
                                            $department = Department::findById($department_id);
                                        @endphp
                                        <span>
                                            {{ $department ? $department->name : '' }} <br>
                                        </span>
                                    @endforeach
                                </td>
                                <td class="p-1">
                                    @if ($item->signatureSubmission)
                                        @foreach ($item->signatureSubmission as $index2 => $item2)
                                            @if ($item2->positions == 4)
                                                <div>SubLeader:
                                                    @if ($item2->status == 0)
                                                        <span> chưa duyệt </span>
                                                        <span class="btn btn-outline-danger"
                                                            style="padding: 0.15rem 0.5rem;">
                                                            <i class="fa fa-times" style="color: red;"></i>
                                                        </span>
                                                    @else
                                                        <button type="button" class="border-0 bg-transparent "
                                                            data-toggle="tooltip" data-html="true"
                                                            data-placement="bottom"
                                                            title="{{ 'SubLeader: ' . @$item2->employee->first_name . @$item2->employee->last_name }} <br>
                                                    {{ 'Duyệt lúc: ' . $item2->updated_at }} ">
                                                            <span> Đã duyệt </span>
                                                            <span style="padding: 0.15rem 0.5rem;"
                                                                class="btn btn-outline-success"><i class="fa fa-check"
                                                                    style="color: green;"></i></span>
                                                        </button>
                                                    @endif
                                                </div>
                                            @else
                                                <div>
                                                    Leader:
                                                    @if ($item2->status == 0)
                                                        <span>chưa duyệt</span>
                                                        <span class="btn btn-outline-danger"
                                                            style="padding: 0.15rem 0.5rem;">
                                                            <i class="fa fa-times" style="color: red;"></i>
                                                        </span>
                                                    @else
                                                        <button type="button" class="border-0 bg-transparent "
                                                            data-toggle="tooltip" data-html="true"
                                                            data-placement="bottom"
                                                            title="{{ 'Leader: ' . @$item2->employee->first_name . @$item2->employee->last_name }} <br>
                                                            {{ 'Duyệt lúc: ' . $item2->updated_at }} ">
                                                            <span> Đã duyệt </span>
                                                            <span style="padding: 0.15rem 0.5rem;"
                                                                class="btn btn-outline-success"><i class="fa fa-check"
                                                                    style="color: green;"></i></span>
                                                        </button>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{ $item->content }}</td>
                                <td>
                                    <a href="{{ route('admin.requireds.complete', ['id' => $item->id]) }}"
                                        class="btn btn-primary text-light ">Xuất hàng</a>
                                </td>
                                <td>
                                    <a title="Xem lịch sử sửa chữa"
                                        class=" d-inline-block mx-1 btn-purple btn-sm text-white" href="">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a title="Xóa" class=" d-inline-block btn-danger btn-sm text-white"
                                        href="{{ route('admin.requireds.trashed.destroy', ['id' => $item->id]) }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span class="record-total">Tổng: {{ $lists->total() }} bản ghi</span>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="pagination-panel">
                        {{ $lists->appends(Request::all())->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
                <div class="col-sm-3 text-right">
                    <span>
                        Hiển thị
                        <select name="per_page" class="form-control" style="display: inline;width: auto;"
                            data-target="#form_lists">
                            @php $list = [5, 10, 20, 50, 100, 200]; @endphp
                            @foreach ($list as $num)
                                <option value="{{ $num }}" {{ $num == $per_page ? 'selected' : '' }}>
                                    {{ $num }}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $('input.date_picker').datepicker({
            autoclose: true,
            dateFormat: "dd-mm-yy"
        }).val();

        function deleteItem(params) {
            swal.fire({
                title: "Bạn có chắc chắn?",
                text: "bản ghi này sẽ được chuyển vào thùng rác!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Vâng, Xóa nó!"
            }).then((result) => {
                if (result.value) {
                    $("#deleteForm" + params).submit();
                }
            })
        }
        // const ajaxURL = "<?php echo Route::is('admin.requireds.trashed' ? 'requireds/trashed/view' : 'requireds'); ?>";
        // $('table#requireds_table').DataTable({
        //     dom: 'Blfrtip',
        //     language: {processing: "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading Data..."},
        //     processing: true,
        //     serverSide: true,
        //     ajax: {url: ajaxURL},
        //     aLengthMenu: [[25, 50, 100, 1000, -1], [25, 50, 100, 1000, "All"]],
        //     buttons: ['excel', 'pdf', 'print'],
        //     columns: [
        //         {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        //         {data: 'title', name: 'title'},
        //         {data: 'image', name: 'image'},
        //         {data: 'status', name: 'status'},
        //         {data: 'action', name: 'action'}
        //     ]
        // });
    </script>
@endsection
