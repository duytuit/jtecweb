@extends('backend.layouts.master')

@section('title')
    @include('backend.pages.departments.partials.title')
@endsection

@section('admin-content')
    @include('backend.pages.departments.partials.header-breadcrumbs')
    <div class="container-fluid">
        @include('backend.layouts.partials.messages')
        <div class="create-page">
            <form action="{{ route('admin.departments.store') }}" method="POST" enctype="multipart/form-data"
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
                            <div class="W-100">
                                <div class="form-group">
                                    <label class="control-label" for="departments_title">Tên bộ phận <span
                                            class="required">*</span></label>
                                    <input type="text" data-parsley-required-message="Tên bộ phận là bắt buộc"
                                        class="form-control" id="departments_title" name="departments_title"
                                        value="{{ old('departments_title') }}" placeholder="" required="">
                                </div>
                            </div>
                            <div class="W-100">
                                <div class="form-group">
                                    <label class="control-label" for="departments_code">Mã bộ phận <span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control"
                                        data-parsley-required-message="Mã bộ phận là bắt buộc" id="departments_code"
                                        name="departments_code" value="{{ old('departments_code') }}" placeholder=""
                                        required="">
                                </div>
                            </div>
                            <div class="w-100">
                                <div class="form-group">
                                    <label class="control-label">Trạng thái</label>
                                    <input type="checkbox" id="_status" data-id="" data-url="" name="status"
                                        value="1" checked />
                                    <label for="_status" class="toggle">
                                        <div class="slider"></div>
                                    </label>
                                </div>
                            </div>

                            <div class="row fixed-bottom">
                                <div class="col-md-6 form-actions mx-auto">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                        Save</button>
                                    <a href="{{ route('admin.departments.index') }}" class="btn btn-dark">Cancel</a>
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
