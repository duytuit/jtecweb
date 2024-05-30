@extends('backend.layouts.master')

@section('title')
    @include('backend.pages.requireds.partials.title')
@endsection
@php
    use App\Models\EmployeeDepartment;
    use App\Models\Employee;
    use App\Models\Department;
@endphp

@section('admin-content')
    @include('backend.pages.requireds.partials.header-breadcrumbs')
    <div class="container-fluid">
        @include('backend.layouts.partials.messages')
        <div class="create-page">
            <form action="{{ route('admin.requireds.store') }}" method="POST" enctype="multipart/form-data"
                data-parsley-validate data-parsley-focus="first">
                @csrf
                {{-- <input type="hidden" name="departmentId" value="{{ $employeeDepartmentFromId->department_id }}"> --}}
                <input type="hidden" id="requiredType" name="requiredType" value="{{ $requiredType }}">
                <div class="form-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header">Bộ phận yêu cầu</h5>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="control-label" for="required_department_id">Bộ phận</label>
                                            <input type="text" class="form-control" id="required_department_id"
                                                name="required_department_id" value="{{ $departmentFromId->name }}"
                                                readonly />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="created_by">Người yêu cầu</label>
                                            <input type="text" class="form-control" id="created_by" name="created_by"
                                                value="{{ $employee->first_name . ' ' . $employee->last_name }}" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="code">Mã linh kiện<span
                                                    class="required">*</span></label>
                                            <input type="text" class="form-control" id="code" name="code"
                                                value="{{ old('code') }}" placeholder="Mã linh kiện" required
                                                data-parsley-required-message="Trường mã lịnh kiện là bắt buộc" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="quantity">Số lượng<span
                                                    class="required">*</span></label>
                                            <input type="number" step="1" min="0" max="100000"
                                                class="form-control" id="quantity" name="quantity"
                                                value="{{ old('quantity') }}" placeholder="Số lượng" required
                                                data-parsley-required-message="Trường số lượng là bắt buộc">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Loại số lượng</label>
                                            <div>
                                                <input name="quantityType" id="quantityUnused"
                                                    style="width:20px;height:20px; vertical-align: middle;" type="radio"
                                                    value="1" required
                                                    data-parsley-error-message="Vui lòng chọn một loại số lượng.">
                                                <label for="quantityUnused">Hàng chẵn</label>
                                                <input name="quantityType" id="quantityUsed"
                                                    style="width:20px;height:20px; vertical-align: middle;" type="radio"
                                                    value="0" required checked>
                                                <label for="quantityUsed">Hàng lẻ</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="unit">Đơn vị</label>
                                            <input type="text" class="form-control" id="unit" name="unit"
                                                value="{{ old('unit') }}" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="material_norms">Định mức</label>
                                            <input type="text" class="form-control" id="material_norms"
                                                name="material_norms" value="{{ old('material_norms') }}" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="content">Ghi chú</label>
                                            <input type="text" class="form-control" id="content" name="content"
                                                value="{{ old('content') }}" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header">Bộ phận Tiếp nhận</h5>
                                    @php
                                        $dataTablesIds = $formTypeJobs['confirm_by_from_dept']; // get id leader, sub leader
                                    @endphp
                                    @foreach ($formTypeJobsDepartmentIds as $formTypeJobsDepartmentId)
                                        @php
                                            $departmentName = Department::find($formTypeJobsDepartmentId);
                                        @endphp
                                        <input type="text" class="form-control" id="department" name="department"
                                            value="{{ $departmentsName = $formTypeJobsDepartmentId ? $departmentName->name : null }}"
                                            readonly>
                                        @foreach ($dataTablesIds as $dataTablesId)
                                            @php
                                                $emp_depts = EmployeeDepartment::where(
                                                    'department_id',
                                                    $formTypeJobsDepartmentId,
                                                )
                                                    ->where('positions', $dataTablesId)
                                                    ->pluck('employee_id')
                                                    ->toArray();
                                            @endphp
                                            @foreach ($emp_depts as $emp_dept)
                                                <span>{{ $positionTitles[$dataTablesId]['name'] . ' :' }}</span>
                                                <span>
                                                    @php
                                                        $emp_name = Employee::find($emp_dept);
                                                    @endphp
                                                    {{ $emp_name ? @$emp_name->first_name . ' ' . @$emp_name->last_name : '' }}</span>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row fixed-bottom">
                        <div class="col-md-6 form-actions mx-auto">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                Lưu</button>
                            <a href="{{ route('admin.requireds.index') }}" class="btn btn-dark">Hủy</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('input[name="code"]').on('input', function(e) {
                e.preventDefault();
                var selectedValue = $(this).val();
                $.ajax({
                    url: "{{ route('admin.requireds.showDataAccessorys') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        selectedValue: selectedValue
                    },
                    success: function(data) {
                        $('#material_norms').val(data.material_norms);
                        $('#unit').val(data.unit);
                        toastr.success("Thành công", 'Success', {
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut",
                            timeOut: 2000
                        });
                    },
                    error: function(xhr, status, error) {
                        toastr.success("Có lỗi xảy ra", 'Error', {
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut",
                            timeOut: 2000
                        });
                    }
                });
            });
        })
    </script>
@endsection
