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
                        <div class="col-6 align-items-center justify-content-center mx-auto">
                            <div class="w-100">
                                <div class="form-group">
                                    <label class="control-label" for="name">
                                        Tên nhân viên<span class="required">*</span>
                                    </label>
                                    <input type="text" data-parsley-required-message="Tên nhân viên là bắt buộc"
                                        class="form-control" id="name" name="name" value="{{ old('name') }}"
                                        placeholder="" required>
                                </div>
                            </div>
                            <div class="w-100">
                                <div class="form-group">
                                    <label class="control-label" for="code">
                                        Mã nhân viên <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control"
                                        data-parsley-required-message="Mã nhân viên là bắt buộc" id="code"
                                        name="code" value="{{ old('code') }}" placeholder="" required>
                                </div>
                            </div>
                            <div class="w-100">
                                <div class="form-group">
                                    <label class="control-label" for="departments">
                                        Bộ phận <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control"
                                        data-parsley-required-message="Bộ phận là bắt buộc" id="departments"
                                        name="departments" value="{{ old('departments') }}" placeholder="">
                                </div>
                            </div>

                            <div class="w-100 btn-group">
                                <button type="button" class="btn btn-outline-warning dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Bộ phận
                                </button>
                                <ul class="w-100 dropdown-menu">
                                    <li>Kho </li>
                                    <li>Cắt</li>
                                    <li>Nối</li>
                                </ul>
                            </div>
                            <hr>
                            <div class="w-100 btn-group">
                                <button type="button" class="btn btn-outline-info  dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Chức vụ
                                </button>
                                <ul class="w-100 dropdown-menu">
                                    <li>Giám đốc </li>
                                    <li>Quản đốc</li>
                                    <li>Leader</li>
                                </ul>
                            </div>
                            {{-- <div class="w-100">
                                <div class="form-group">
                                    <label class="control-label">Trạng thái</label>
                                    <input type="checkbox" id="_status" data-id="" data-url="" name="status"
                                        value="1" checked class="d-none" />
                                    <label for="_status" class="toggle">
                                        <div class="slider"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-success">
                                    <label class="control-label" for="status">Status <span
                                            class="required">*</span></label>
                                    <select class="form-control custom-select" id="status" name="status" required>
                                        <option value="1" {{ old('status') === 1 ? 'selected' : null }}>Active</option>
                                        <option value="0" {{ old('status') === 0 ? 'selected' : null }}>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                             --}}
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
    <script></script>
@endsection
