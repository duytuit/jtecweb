@extends('backend.layouts.master')
@php
    use App\Models\Employee;
@endphp
@section('admin-content')
    @include('backend.pages.checkCutMachine.partials.header-breadcrumbs')
    <div class="container-fluid ">
        <form id="form-search" action="{{ route('admin.checkCutMachine.index') }}" method="get">
            @csrf

            <div class="row form-group">
                <div class="col-sm-8">
                    <span class="btn-group">
                        <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Tác vụ <span
                                class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a class="btn-action" data-target="#form_lists" data-method="delete" href="javascript:;"><i
                                        class="fa fa-trash" style="color: #cb3030;"></i> Xóa</a></li>
                            <li><a class="btn-action" data-target="#form_lists" data-method="active" href="javascript:;"><i
                                        class="fa fa-check-circle" style="color: #3800df;"></i> Duyệt</a></li>
                            <li><a class="btn-action" data-target="#form_lists" data-method="inactive"
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
        <form id="form-search-advance" action="{{ route('admin.checkCutMachine.index') }}" method="get" class="hidden">
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
                    {{-- <div class="col-sm-2">
                        <select class="form-control custom-select" name="worker">
                            <option value="">Tình trạng làm việc</option>
                            @foreach ($workers as $worker)
                                <option value="{{ $worker['id'] }}">
                                    {{ $worker['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control custom-select" name="positions">
                            <option value="">Chức vụ</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position['id'] }}">
                                    {{ $position['name'] }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="col-sm-2">
                        <button class="btn btn-warning btn-block">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- END #form-search-advance -->
        <form id="form_lists" action="{{ route('admin.checkCutMachine.action') }}" method="post">
            @csrf
            <input type="hidden" name="method" value="" />
            <div class="table-responsive product-table overflow-x-scroll ">
                <table class="table table-bordered" id="checkCutMachine_table" style="min-width: 1280px; ">
                    <thead>
                        <tr>
                            <th width="3%"><input type="checkbox" class="greyCheck checkAll"
                                    data-target=".checkSingle" /></th>
                            <th>TT</th>
                            <th>Mã yêu cầu</th>
                            <th>Người thực hiện</th>
                            <th>Bộ phận</th>
                            <th>Máy</th>
                            <th>Ngày-giờ thực hiện</th>
                            <th>Trạng thái</th>
                            <th>Lý do - Sửa chữa</th>
                            <th>Tình trạng Duyệt</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lists as $index => $item)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{ $item->id }}"
                                        class="greyCheck checkSingle" /></td>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ @$item->employee->first_name . ' ' . $item->employee->last_name }}</td>
                                <td>{{ @$item->employeeDepartment->department->name }}</td>
                                @php
                                    $contentForm = json_decode($item->content_form);
                                @endphp
                                <td>{{ $contentForm->name_machine }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td class="text-center">
                                    <div class="dropdown show">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            @if ($item->status)
                                                <span class="badge badge-success font-weight-100">OK</span>
                                            @else
                                                <span class="badge badge-warning">NG</span>
                                            @endif
                                        </a>

                                        <div class="dropdown-menu z-n1 " aria-labelledby="dropdownMenuLink">
                                            @php
                                                $contentFormChecks = $contentForm->check_list;
                                            @endphp
                                            @foreach ($contentFormChecks as $index => $item1)
                                                <div class="dropdown-item" href="#">
                                                    {{ $item1->id + 1 }}.{{ $item1->position }}
                                                    @if ($item1->answer)
                                                        <span class="badge badge-success font-weight-100">OK</span>
                                                    @else
                                                        <span class="badge badge-warning">NG</span>
                                                    @endif
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                </td>
                                <td>{{ $item->content }}</td>
                                <td class="p-1">
                                    @if ($item->signatureSubmission)
                                        @foreach ($item->signatureSubmission as $index2 => $item2)
                                            @if ($item2->positions == 4)
                                                <div>SubLeader: {{ $item2->status == 0 ? 'chưa duyệt' : 'đã duyệt' }} <i
                                                        class="fa fa-check" style="color: green;"></i></div>
                                            @else
                                                <div>Leader: {{ $item2->status == 0 ? 'chưa duyệt' : 'đã duyệt' }} <i
                                                        class="fa fa-check" style="color: green;"></i></div>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a title="Xem lý do sửa chữa"
                                        class=" d-inline-block mx-1 btn-purple btn-sm text-white"
                                        href="{{ route('admin.departments.edit', ['id' => $item->id]) }}"><i
                                            class="fa fa-eye"></i> </a>
                                    <a title="Xóa" class=" d-inline-block btn-danger btn-sm text-white"
                                        href="{{ route('admin.departments.trashed.destroy', ['id' => $item->id]) }}"><i
                                            class="fa fa-trash"></i> </a>
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
    </script>
@endsection
