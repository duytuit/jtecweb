@extends('backend.layouts.master')

@section('title')
    @include('backend.pages.employees.partials.title')
@endsection

@section('admin-content')
    @include('backend.pages.employees.partials.header-breadcrumbs')
    <div class="container-fluid">
        @include('backend.pages.employees.partials.top-show')
        @include('backend.layouts.partials.messages')
        <form id="form-search" action="{{ route('admin.employees.index') }}" method="get">
            <div class="table-responsive product-table">
                <table class="table table-striped table-bordered display ajax_view" id="employees_table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>STT</th>
                            <th>Mã Code</th>
                            <th>Tên nhân viên</th>
                            <th>Chức vụ</th>
                            <th>Bộ phận</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lists as $index => $item)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{ $item->id }}"
                                        class="greyCheck checkSingle" /></td>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
                                <td>{{ $item->positions }}</td>
                                <td>Bộ phận</td>
                                <td>
                                    <a class=" d-inline-block mx-1"
                                        href="{{ route('admin.employees.edit', ['id' => $item->id]) }}"><i
                                            class="fa fa-edit" style="color: #0ecf48;"></i> Sửa</a>
                                    <a class=" d-inline-block"
                                        href="{{ route('admin.employees.trashed.destroy', ['id' => $item->id]) }}"><i
                                            class="fa fa-trash" style="color: #cb3030;"></i> Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        const ajaxURL = "<?php echo Route::is('admin.employees.trashed' ? 'employees/trashed/view' : 'employees'); ?>";
        $('table#employees_table').DataTable({
            dom: 'Blfrtip',
            language: {
                processing: "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading Data..."
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: ajaxURL
            },
            aLengthMenu: [
                [25, 50, 100, 1000, -1],
                [25, 50, 100, 1000, "All"]
            ],
            buttons: ['excel', 'pdf', 'print'],
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
    </script>
@endsection
