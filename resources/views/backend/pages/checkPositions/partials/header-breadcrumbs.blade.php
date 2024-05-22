<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">
                @if (Route::is('admin.checkPositions.index'))
                    Danh sách check list
                @elseif(Route::is('admin.checkPositions.create'))
                    Kiểm tra
                @elseif(Route::is('admin.checkPositions.edit'))
                    {{-- Sửa <span class="badge badge-info">{{ $checkPositions->name }}</span> --}}
                @endif
            </h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        @if (Route::is('admin.checkPositions.index'))
                            <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
                        @elseif(Route::is('admin.checkPositions.create'))
                            <li class="breadcrumb-item"><a href="{{ route('admin.checkPositions.index') }}">Danh
                                    sách</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Kiểm tra</li>
                        @elseif(Route::is('admin.checkPositions.edit'))
                            <li class="breadcrumb-item"><a href="{{ route('admin.checkPositions.index') }}">Danh
                                    sách</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Sửa</li>
                        @endif

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
