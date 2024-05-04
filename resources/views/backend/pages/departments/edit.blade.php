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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="departments_title">Tên bộ phận <span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control" id="departments_title"
                                        name="departments_title" value="{{ $department->name }}" placeholder=""
                                        required="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="departments_code">department Title <span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control" id="departments_code" name="departments_code"
                                        value="{{ $department->code }}" placeholder="" required="" />
                                </div>
                            </div>
                        </div>


                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="image">department Featured Image <span
                                            class="optional">(optional)</span></label>
                                    <input type="file" class="form-control dropify" data-height="70"
                                        data-allowed-file-extensions="png jpg jpeg webp" id="image" name="image"
                                        data-default-file="{{ $department->image != null ? asset('public/assets/images/departments/' . $department->image) : null }}" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group has-success">
                                    <label class="control-label" for="status">Status <span
                                            class="required">*</span></label>
                                    <select class="form-control custom-select" id="status" name="status" required>
                                        <option value="1" {{ $department->status === 1 ? 'selected' : null }}>Active
                                        </option>
                                        <option value="0" {{ $department->status === 0 ? 'selected' : null }}>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="description">department Description <span
                                            class="optional">(optional)</span></label>
                                    <textarea type="text" class="form-control tinymce_advance" id="description" name="description">{!! $department->description !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="meta_description">department Meta Description <span
                                            class="optional">(optional)</span></label>
                                    <textarea type="text" class="form-control" id="meta_description" name="meta_description"
                                        placeholder="Meta description for SEO">{!! $department->meta_description !!}</textarea>
                                </div>
                                <div class="form-actions">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                            Save</button>
                                        <a href="{{ route('admin.departments.index') }}" class="btn btn-dark">Cancel</a>
                                    </div>
                                </div>
                            </div>

                        </div> --}}
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
        $(".categories_select").select2({
            placeholder: "Select a Category"
        });
    </script>
@endsection
