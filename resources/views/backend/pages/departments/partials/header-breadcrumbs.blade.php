<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">
                @if (Route::is('admin.departments.index'))
                    Departments List
                @elseif(Route::is('admin.departments.create'))
                    Create New Departments
                @elseif(Route::is('admin.departments.edit'))
                    Edit Departments <span class="badge badge-info">{{ $departments->title }}</span>
                @elseif(Route::is('admin.departments.show'))
                    View Departments <span class="badge badge-info">{{ $departments->title }}</span>
                    <a  class="btn btn-outline-success btn-sm" href="{{ route('admin.departments.edit', $departments->id) }}"> <i class="fa fa-edit"></i></a>
                @endif
            </h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        @if (Route::is('admin.departments.index'))
                            <li class="breadcrumb-item active" aria-current="page">Departments List</li>
                        @elseif(Route::is('admin.departments.create'))
                        <li class="breadcrumb-item"><a href="{{ route('admin.departments.index') }}">Departments List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create New Departments</li>
                        @elseif(Route::is('admin.departments.edit'))
                        <li class="breadcrumb-item"><a href="{{ route('admin.departments.index') }}">Departments List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Departments</li>
                        @elseif(Route::is('admin.departments.show'))
                        <li class="breadcrumb-item"><a href="{{ route('admin.departments.index') }}">Departments List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Show Departments</li>
                        @endif

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
