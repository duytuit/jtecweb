@extends('backend.layouts.master')

@section('title')
    @include('backend.pages.departments.partials.title')
@endsection

@section('admin-content')
    @include('backend.pages.departments.partials.header-breadcrumbs')
    <div class="container-fluid">
        @include('backend.layouts.partials.messages')
        <div class="create-page">
            <form action="{{ route('admin.departments.update', ['id' => $department->id]) }}" method="POST"
                enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first">
                @csrf
                <input type="hidden" name="departmentId" id="departmentId" value="{{ $department->id }}">
                <div class="form-body">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="name">Tên bộ phận <span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $department->name }}" placeholder="" required="" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="code">Mã bộ phận <span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control" id="code" name="code"
                                        value="{{ $department->code }}" placeholder="" required="" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Trạng thái</label>
                                    <input type="checkbox" id="_status" data-id="" data-url="" name="status"
                                        value="{{ $department->status }}" checked class="d-none" />
                                    <label for="_status" class="toggle">
                                        <div class="slider"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-9">
                                <select name="ids[]" multiple id="codecode" class="form-control" style="width:100%">
                                    <option value="">Chọn mã nhân viên</option>
                                </select>
                            </div>
                            <div class="col-md-3 flex-fill">
                                <button class="btn btn-light w-100 add_btn_js">Thêm</button>
                            </div>
                        </div>
                        <div class="row w-100 mx-auto ">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Tên nhân viên</th>
                                        <th>Chức vụ</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>


                                @foreach ($employeeDepartments as $employeeDepartment)
                                    <tr>
                                        <td>{{ @$employeeDepartment->employee->code }}</td>
                                        <td>{{ @$employeeDepartment->employee->first_name . ' ' . @$employeeDepartment->employee->last_name }}
                                        </td>
                                        <td>
                                            <select class="form-control custom-select" id="positionTitle"
                                                name="positionTitle"
                                                onchange="changePosition(this,{{ $employeeDepartment->id }})">
                                                @foreach ($positionTitles as $positionTitle)
                                                    <option value="{{ $positionTitle['id'] }}"
                                                        {{ $positionTitle['id'] === $employeeDepartment->positions ? 'selected' : '' }}>
                                                        {{ $positionTitle['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <a class=" d-inline-block" href=""><i class="fa fa-trash"
                                                    style="color: #cb3030;"></i> Xóa</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="form-actions">
                            <div class="card-body">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                    Save</button>
                                <a href="{{ route('admin.departments.index') }}" class="btn btn-dark">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
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
        get_data_select_code({
            object: '#codecode',
            url: '{{ url('admin/departments/ajaxGetSelectCode') }}',
            data_id: 'id',
            data_code: 'code',
            data_first_name: 'first_name',
            data_last_name: 'last_name',
            title_default: 'Chọn mã nhân viên',

        });

        function get_data_select_code(options) {
            $(options.object).select2({
                ajax: {
                    url: options.url,
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term,
                        }
                        return query;
                    },
                    processResults: function(json, params) {
                        var results = [{
                            id: '',
                            text: options.title_default
                        }];

                        for (i in json.data) {
                            var item = json.data[i];
                            results.push({
                                id: item[options.data_id],
                                text: item[options.data_code] + ' - ' + item[options.data_first_name] +
                                    ' ' +
                                    item[options.data_last_name]
                            });
                        }
                        return {
                            results: results,
                        };
                    },
                    minimumInputLength: 3,
                }
            });
        }
        $('.add_btn_js').click(function(e) {
            e.preventDefault();
            values = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                ids: JSON.stringify($('#codecode').val()),
                departmentId: $('#departmentId').val()
            }
            $.ajax({
                url: "{{ route('admin.departments.addEmployeeIntoDepartment') }}",
                method: 'POST',
                data: values,
                success: function(data) {
                    window.location.reload();
                },
                errors: function(data) {}
            })
        })

        function changePosition(event, employeeDepartmentId) {
            // event.preventDefault();
            values = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                positionTitle: $('#positionTitle').val(),
                employeeDepartmentId: employeeDepartmentId,
            }
            $.ajax({
                url: "{{ route('admin.departments.changePositionTitle') }}",
                method: 'POST',
                data: values,
                success: function(data) {
                    console.log('Đã lưu giá trị thành công!');
                    toastr.success("Thành công", 'Success', {
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut",
                        timeOut: 2000
                    });
                },
                error: function(data) {
                    console.error('Lỗi khi lưu giá trị:', error);
                }
            });
        };
    </script>
@endsection
