@extends('backend.layouts.master')

@section('title')
    @include('backend.pages.exams.partials.title')
@endsection

@section('admin-content')
    @include('backend.pages.exams.partials.header-breadcrumbs')
    <div class="container-fluid">
        {{-- @include('backend.pages.exams.partials.top-show') --}}
        @include('backend.layouts.partials.messages')
        <form id="form-search" action="{{ route('admin.exams.index') }}" method="get">
            <div class="row form-group">
                <div class="col-sm-8">
                    <span class="btn-group">
                        <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Tác vụ <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a class="btn-action" data-target="#form-categories" data-method="delete" href="javascript:;"><i class="fa fa-trash"></i> Xóa</a></li>
                            <li><a class="btn-action" data-target="#form-categories" data-method="active" href="javascript:;"><i class="fa fa-check"></i> Active</a></li>
                            <li><a class="btn-action" data-target="#form-categories" data-method="inactive" href="javascript:;"><i class="fa fa-times"></i> Inactive</a></li>
                        </ul>
                    </span>
                    <a href="#" class="btn btn-info"><i class="fa fa-edit"></i> Thêm mới</a>
                    <a href="#" class="btn btn-success"><i class="fa fa-edit"></i> Export</a>
                </div>
                <div class="col-sm-4 text-right">
                    <div class="input-group">
                        <input type="text" name="keyword" value="{{ $keyword }}" placeholder="Nhập từ khóa" class="form-control" />
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                            <button type="button" class="btn btn-warning btn-search-advance" data-toggle="show" data-target=".search-advance"><span class="fa fa-filter"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form><!-- END #form-search -->
        <form id="form-search-advance" action="{{ route('admin.exams.index') }}" method="get" class="hidden">
            <div id="search-advance" class="search-advance" style="display: {{ $advance ? 'block' : 'none' }};">
                <div class="row form-group space-5">
                    <div class="col-sm-3">
                        <input type="text" name="keyword" value="{{ $keyword }}" placeholder="Nhập từ khóa" class="form-control" />
                    </div>
                    <div class="col-sm-3">
                        <input type="text" placeholder="Người tạo" class="form-control" />
                    </div>
                    <div class="col-sm-3">
                        <select name="status" class="form-control" style="width: 100%;">
                            <option value="">Trạng thái</option>
                            <option value="1" {{ @$filter['status'] === '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ @$filter['status'] === '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-warning btn-block">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </form><!-- END #form-search-advance -->
        <form id="form_lists" action="{{ route('admin.exams.action') }}" method="post">
            @csrf
            <input type="hidden" name="method" value="" />
            <input type="hidden" name="status" value="" />
            <div class="table-responsive product-table">
                <table class="table table-striped table-bordered display" id="exams_table">
                    <thead>
                        <tr>
                            <th width="3%"><input type="checkbox" class="greyCheck checkAll" data-target=".checkSingle" /></th>
                            <th>TT</th>
                            <th>Mã NV</th>
                            <th>Tên NV</th>
                            <th>Công đoạn</th>
                            <th>Kỳ thi</th>
                            <th>Ngày thi</th>
                            <th>Tổng câu</th>
                            <th>Trả lời đúng</th>
                            <th>Điểm</th>
                            <th>Thời gian làm bài</th>
                            <th>Trạng thái</th>
                            <th>Người duyệt</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($lists as $index=> $item)
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="{{ $item->id }}" class="greyCheck checkSingle" /></td>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->sub_dept ==1?'Cắm':'' }}</td>
                            <td>{{ $item->cycle_name }}</td>
                            <td>{{ $item->create_date }}</td>
                            <td>{{ $item->total_questions }}</td>
                            <td>{{ $item->results }}</td>
                            <td>{{ round(($item->results/$item->total_questions)*100) }}</td>
                            <td>{{ $item->counting_time }}</td>
                            <td></td>
                            <td>
                                @if ( $item->status)
                                    <span class="badge badge-success font-weight-100">Đã duyệt</span>
                                @else
                                    <span class="badge badge-warning">Chờ duyệt</span>
                                @endif
                            </td>
                            <td>
                                <a href="javascript:;" class="btn waves-effect waves-light btn-danger btn-sm btn-circle ml-1 text-white btn-delete" data-url="{{ route('admin.exams.trashed.destroy',[$item->id]) }}" data-id="{{$item->id}}" data-token="{{ csrf_token() }}" title="Delete Admin">
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
                        <select name="per_page" class="form-control" style="display: inline;width: auto;" data-target="#form_lists">
                            @php $list = [5, 10, 20, 50, 100, 200]; @endphp
                            @foreach ($list as $num)
                                <option value="{{ $num }}" {{ $num == $per_page ? 'selected' : '' }}>{{ $num }}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
            </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('a.deleteItem').click(function () {
            var target = $(this).data('target');
            $("#deleteForm").attr("action", $(this).data('action'));
            var $form = $(target);
            swal.fire({
                 title: "Are you sure?",
                 text: "exam will be deleted as trashed !",
                 type: "warning",
                 showCancelButton: true,
                 confirmButtonColor: "#DD6B55",
                 confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    $("#deleteForm").submit();
                }
            })

        })

    </script>
@endsection
