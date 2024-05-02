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
                    <div class="card-body">
                        <div class="row align-items-center justify-content-center ">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="title">Tên bộ phận <span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title') }}" placeholder="" required="" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label" for="title">Mã bộ phận <span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title') }}" placeholder="" required="" />
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="slug">Short URL <span
                                            class="optional">(optional)</span></label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        value="{{ old('slug') }}"
                                        placeholder="Enter short url (Keep blank to auto generate)" />
                                </div>
                            </div> --}}
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Trạng thái</label>
                                    <input type="checkbox" id="_status" data-id="" data-url="" checked />
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
