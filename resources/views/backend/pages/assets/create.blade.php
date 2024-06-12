@extends('backend.layouts.master')

@section('title')
    @include('backend.pages.assets.partials.title')
@endsection

@section('admin-content')
    @include('backend.pages.assets.partials.header-breadcrumbs')
    <div class="container-fluid">
        @include('backend.layouts.partials.messages')
        <div class="create-page">
            <form action="{{ route('admin.assets.store') }}" method="POST" enctype="multipart/form-data"
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
                                    <label class="control-label" for="code">Mã tài sản<span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control"
                                        data-parsley-required-message="Mã tài sản là bắt buộc" id="code" name="code"
                                        value="{{ old('code') }}" placeholder="" required="">
                                </div>
                            </div>
                            <div class="w-100">
                                <div class="form-group">
                                    <label class="control-label" for="name">Tên tài sản<span
                                            class="required">*</span></label>
                                    <input type="text" data-parsley-required-message="Tên tài sản là bắt buộc"
                                        class="form-control" id="name" name="name" value="{{ old('name') }}"
                                        placeholder="" required="">
                                </div>
                            </div>
                            <div class="w-100">
                                <div class="form-group">
                                    <label class="control-label" for="image">Ảnh nhân viên 4x6</label>
                                    <input type="file" class="form-control dropify" data-height="100"
                                        data-allowed-file-extensions="png jpg jpeg webp" id="image" name="image" />
                                </div>
                            </div>
                            <div class="w-100">
                                <div class="form-group">
                                    <label class="control-label">Ghi chú</label>
                                    <input class="form-control" type="text" name="note" value="{{ old('note') }}" />
                                </div>
                            </div>
                            <div class="w-100">
                                <div class="form-group">
                                    <label class="control-label">Trạng thái</label>
                                    <input type="checkbox" id="_status" data-id="" data-url="" name="status"
                                        value="1" checked class="d-none" />
                                    <label for="_status" class="toggle">
                                        <div class="slider"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="row fixed-bottom">
                                <div class="col-md-6 form-actions mx-auto">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                        Lưu</button>
                                    <a href="{{ route('admin.assets.index') }}" class="btn btn-dark">Hủy</a>
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

    </script>
@endsection
