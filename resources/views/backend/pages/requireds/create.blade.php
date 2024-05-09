@extends('backend.layouts.master')

@section('title')
    @include('backend.pages.requireds.partials.title')
@endsection

@section('admin-content')
    @include('backend.pages.requireds.partials.header-breadcrumbs')
    <div class="container-fluid">
        @include('backend.layouts.partials.messages')
        <div class="create-page">
            <form action="{{ route('admin.requireds.store') }}" method="POST" enctype="multipart/form-data"
                data-parsley-validate data-parsley-focus="first">
                @csrf
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
                                                name="required_department_id" value="{{ old('required_department_id') }}"
                                                readonly />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="created_by">Người yêu cầu</label>
                                            <input type="text" class="form-control" id="created_by" name="created_by"
                                                value="{{ old('created_by') }}" readonly />
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
                                            <input type="number" class="form-control" id="quantity" name="quantity"
                                                value="{{ old('quantity') }}" placeholder="Số lượng" required
                                                data-parsley-required-message="Trường số lượng là bắt buộc" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Loại số lượng</label>

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
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="control-label" for="department">Bộ phận</label>
                                            <input type="text" class="form-control" id="department" name="department"
                                                value="{{ old('department') }}" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row fixed-bottom">
                        <div class="col-md-6 form-actions mx-auto">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                Save</button>
                            <a href="{{ route('admin.requireds.index') }}" class="btn btn-dark">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $('input[name="code"]').on('change', function() {
                var selectedValue = $(this).val();
                values = {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    selectedValue: selectedValue,
                }
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.requireds.showDataAccessorys') }}",
                    data: values,
                    // data: JSON.stringify(values),
                    contentType: 'application/json',
                    success: (response) => {
                        console.log(response);
                        if (response) {
                            toastr.success("Thành công", 'Success', {
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut",
                                timeOut: 2000
                            });
                            window.location.reload();
                        }
                    },
                    error: function(response) {
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
