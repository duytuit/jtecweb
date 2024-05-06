@extends('backend.layouts.master')

@section('title')
    @include('backend.pages.employees.partials.title')
@endsection

@section('admin-content')
    @include('backend.pages.employees.partials.header-breadcrumbs')
    <div class="container-fluid">
        @include('backend.layouts.partials.messages')
        <div class="create-page">
            <form action="{{ route('admin.employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data"
                data-parsley-validate data-parsley-focus="first">
                @csrf
                <div class="form-body">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="first_name">Họ và tên đệm<span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        value="{{ $employee->first_name }}" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="last_name">Tên nhân viên <span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        value="{{ $employee->last_name }}" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="code">Mã nhân viên <span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control" id="code" name="code"
                                        value="{{ $employee->code }}" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-4 btn-group">
                                <div class="form-group w-100">
                                    <label class="control-label" for="">Bộ phận</label><br>
                                    <select class="form-control" id="process_id" name="process_id">
                                        <option value="{{ $employee->process_id }}">{{ $employee->process_id }}</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="card-body">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                    Save</button>
                                <a href="{{ route('admin.employees.index') }}" class="btn btn-dark">Cancel</a>
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
