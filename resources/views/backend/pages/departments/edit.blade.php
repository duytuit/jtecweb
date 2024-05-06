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
    <script></script>
@endsection
