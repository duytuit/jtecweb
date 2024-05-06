@extends('backend.layouts.master')

@section('title')
    @include('backend.pages.employees.partials.title')
@endsection

@section('admin-content')
    @include('backend.pages.employees.partials.header-breadcrumbs')
    <div class="container-fluid">
        @include('backend.layouts.partials.messages')
        <div class="create-page">
            <form action="{{ route('admin.employees.store') }}" method="POST" enctype="multipart/form-data"
                data-parsley-validate data-parsley-focus="first">
                @csrf
                <div class="form-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="first_name">
                                        Họ và tên đệm<span class="required">*</span>
                                    </label>
                                    <input type="text" data-parsley-required-message="Họ và tên đệm là bắt buộc"
                                        class="form-control" id="first_name" name="first_name"
                                        value="{{ old('first_name') }}" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="last_name">
                                        Tên nhân viên<span class="required">*</span>
                                    </label>
                                    <input type="text" data-parsley-required-message="Tên nhân viên là bắt buộc"
                                        class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}"
                                        placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="code">
                                        Mã nhân viên <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control"
                                        data-parsley-required-message="Mã nhân viên là bắt buộc" id="code"
                                        name="code" value="{{ old('code') }}" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-4 btn-group">
                                <div class="form-group w-100">
                                    <label class="control-label" for="">Bộ phận</label><br>
                                    <select class="form-control" id="process_id" name="process_id">
                                        <option value="">Chọn bộ phận</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 btn-group">
                                <div class="form-group w-100">
                                    <label class="control-label" for="">Chức vụ</label><br>
                                    <select class="form-control" id="positions" name="positions">
                                        <option value="">Chọn chức vụ</option>
                                        <option value="11" {{ old('positions') === 11 ? 'selected' : null }}>Worker
                                        </option>
                                        <option value="10" {{ old('positions') === 10 ? 'selected' : null }}>Sub Leader
                                        </option>
                                        <option value="9" {{ old('positions') === 9 ? 'selected' : null }}>Leader
                                        </option>
                                        <option value="8" {{ old('positions') === 8 ? 'selected' : null }}>Suppser
                                            Leader
                                        </option>
                                        <option value="7" {{ old('positions') === 7 ? 'selected' : null }}>Staff
                                        </option>
                                        <option value="6" {{ old('positions') === 6 ? 'selected' : null }}>Chief
                                        </option>
                                        <option value="5" {{ old('positions') === 5 ? 'selected' : null }}>Supper
                                            Chief
                                        </option>
                                        <option value="4" {{ old('positions') === 4 ? 'selected' : null }}>Manager
                                        </option>
                                        <option value="3" {{ old('positions') === 3 ? 'selected' : null }}>Supper
                                            Manager
                                        </option>
                                        <option value="2" {{ old('positions') === 2 ? 'selected' : null }}>Director
                                        </option>
                                        <option value="1" {{ old('positions') === 1 ? 'selected' : null }}>General
                                            Director
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="identity_card">
                                        Số CCCD
                                    </label>
                                    <input type="text" class="form-control" id="identity_card" name="identity_card"
                                        value="{{ old('identity_card') }}" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="begin_date_company">
                                        Ngày vào công ty
                                    </label>
                                    <input type="text" class="form-control datepicker" name="begin_date_company"
                                        id="begin_date_company" value="" placeholder="" autocomplete="off"
                                        data-date-format="dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="end_date_company">
                                        Ngày nghỉ việc
                                    </label>
                                    <input type="text" class="form-control datepicker" name="end_date_company"
                                        id="end_date_company" value="" placeholder="" autocomplete="off"
                                        data-date-format="dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="birthday">
                                        Ngày tháng năm sinh
                                    </label>
                                    <input type="text" class="form-control datepicker" name="birthday" id="birthday"
                                        value="{{ old('birthday') }}" placeholder="" autocomplete="off"
                                        data-date-format="dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-success">
                                    <label class="control-label" for="status">Status</label>
                                    <select class="form-control custom-select" id="status" name="status">
                                        <option value="1" {{ old('status') === 1 ? 'selected' : null }}>Active
                                        </option>
                                        <option value="0" {{ old('status') === 0 ? 'selected' : null }}>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-success">
                                    <label class="control-label" for="worker">Tình trạng làm việc</label>
                                    <select class="form-control custom-select" id="worker" name="worker">
                                        <option value="3" {{ old('worker') === 3 ? 'selected' : null }}>Đang làm việc
                                        </option>
                                        <option value="2" {{ old('worker') === 2 ? 'selected' : null }}>Nghỉ không
                                            lương
                                        </option>
                                        <option value="1" {{ old('worker') === 1 ? 'selected' : null }}>Nghỉ chế độ
                                            bảo hiểm
                                        </option>
                                        <option value="0" {{ old('worker') === 0 ? 'selected' : null }}>Nghỉ việc
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-success">
                                    <label class="control-label" for="marital">Tình trạng hôn nhân</label>
                                    <select class="form-control custom-select" id="marital" name="marital">
                                        <option value="0" {{ old('marital') === 3 ? 'selected' : null }}>Chưa kết hôn
                                        </option>
                                        <option value="1" {{ old('marital') === 2 ? 'selected' : null }}>Đã kết hôn
                                        </option>
                                        <option value="2" {{ old('marital') === 1 ? 'selected' : null }}>Ly hôn
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="addresss">
                                        Địa chỉ
                                    </label>
                                    <input type="text" class="form-control" id="addresss" name="addresss"
                                        value="{{ old('addresss') }}" placeholder="">
                                </div>
                            </div>
                            <div class="row fixed-bottom">
                                <div class="col-md-6 form-actions mx-auto">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check"></i> Save
                                    </button>
                                    <a href="{{ route('admin.employees.index') }}" class="btn btn-dark">Cancel</a>
                                </div>
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
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy'
        });
    </script>
@endsection
