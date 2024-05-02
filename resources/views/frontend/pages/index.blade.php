@extends('frontend.layouts.master')

@section('title')
    {{ config('app.name') }} | {{ config('app.description') }}
@endsection

@section('main-content')
    <main class="main">

        <!-- Page Content -->
        <div class="container">
            <div class="cards">
                <div class="cards_item">
                    <div class="card js_card_btn" data-type="1">
                        <div class="card_content">
                            <h2 class="card_title">Công Đoạn Cắm</h2>
                            <p class="card_text">Kiểm tra năng lực nhận biết màu dây</p>
                            <a href="javascript:;" class="btn card_btn">Bắt đầu làm bài</a>
                        </div>
                    </div>
                </div>
                <div class="cards_item js_card_btn" data-type="2">
                    <div class="card">
                        <div class="card_content">
                            <h2 class="card_title">Công Đoạn Cắm</h2>
                            <p class="card_text">Kiểm tra đánh giá công nhân</p>
                            <a href="javascript:;" class="btn card_btn">Bắt đầu làm bài</a>
                        </div>
                    </div>
                </div>
                <div class="cards_item">
                    <div class="card">
                        <div class="card_content">
                            <a href="/qrcode#cat">
                                <h2 class="card_title">
                                    Tạo QR code
                                </h2>
                                <p class="card_text">Bộ phận Cắt</p>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="cards_item">
                    <div class="card">
                        <div class="card_content">
                            <a href="/qrcode#kho">
                                <h2 class="card_title">
                                    Tạo QR code
                                </h2>
                                <p class="card_text">Bộ phận Kho</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="cards_item">
                    <div class="card">
                        <div class="card_content">
                            <h2 class="card_title">
                                <a href="question/import">Thêm câu hỏi từ file excel</a>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="cards_item">
                    <div class="card">
                        <div class="card_content">
                            <h2 class="card_title">
                                <a href="/admin/checkTension/">Kiểm tra sức căng</a>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="cards_item">
                    <div class="card">

                        <div class="card_content">
                            <h2 class="card_title">Công đoạn Demo</h2>
                            <p class="card_text">Nội dung kiểm tra</p>
                            <a href="#" class="btn card_btn">Bắt đầu làm bài</a>
                        </div>
                    </div>
                </div>
                <div class="cards_item">
                    <div class="card">
                        {{-- <div class="card_image"><img src="https://picsum.photos/500/300/?image=2"></div> --}}
                        <div class="card_content">
                            <h2 class="card_title">Công đoạn Demo</h2>
                            <p class="card_text">thay đổi code đoạn này</p>
                            <a href="#" class="btn card_btn">Bắt đầu làm bài</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="modalConfirmCode" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Xác nhận mã nhân viên</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="confirmCode" action="{{ route('exam') }}" method="GET">
                        <input type="text" name="code" class="form-control" placeholder="Nhập mã nhân viên" required>
                        <input type="hidden" name="type" id="confirmType">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                    <button type="submit" form="confirmCode" class="btn btn-primary">Bắt đầu thi</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('.js_card_btn').click(function() {
            type = $(this).data('type');
            $('#confirmType').val(type);
            if (type == 1) {
                $('#confirmCode').attr('action', '{{ route('exam') }}');
            } else if (type == 2) {
                $('#confirmCode').attr('action', '{{ route('examNew') }}');
            }
            $('#modalConfirmCode').modal('show');

        })
    </script>
@endsection
