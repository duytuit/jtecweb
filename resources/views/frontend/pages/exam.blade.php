@extends('frontend.layouts.master')

@section('title')
    {{ config('app.name') }} | {{ config('app.description') }}
@endsection

@section('main-content')
    <main class="main">
        <!-- Page Content -->
        <div class="container">
            <form action="">
                <table style="width: 100%; padding: 10px" border="1">
                    <thead>
                         <tr>
                            <div>
                                <strong style=" text-transform: uppercase;">Bài kiểm tra năng lực nhận biết màu dây</strong>
                            </div>
                        </tr>
                         <tr>
                            <i>Điểm đạt: 80-100</i><br>
                            <i>Từ 50->79 điểm: kiểm tra lại sai 2 ngày (nếu không đạt sẽ được đào tạo lại)</i><br>
                            <i>Dưới 50 điểm: Không đạt ( đào tạo lại màu dây 1 tuần)</i><br>
                            <i>Thời gian làm bài <strong>05:00</strong></i><br>
                            <i>Thời gian còn lại là: <strong>01:00</strong></i><br>
                         </tr>
                         <tr>
                            <div>
                               Công đoạn:
                            </div>
                            <div>
                                <input type="text" name="congdoan" class="form-control">
                            </div>
                            <div>
                                Họ và tên:
                             </div>
                             <div>
                                 <input type="text" name="hovaten" class="form-control">
                             </div>
                             <div>
                                Mã nhận viên:
                             </div>
                             <div>
                                 <input type="text" name="manhanvien" class="form-control">
                             </div>
                             <div>
                                Ngày kiểm tra:
                             </div>
                             <div>
                                 <input type="date" name="ngaykiemtra" class="form-control" style="width:100%">
                             </div>
                         </tr>
                    </thead>
                    <tbody>
                         <tr>
                            <div class="form-group">
                                <div><strong>Câu 1 : </strong>Màu dây <strong>Trắng - Đỏ</strong> ký hiệu là gì ?</div>
                                <div> <img src="{{ asset('public/assets/frontend/images/anh-mau-day/trang-do.png') }}" alt="" width="200" /></div>
                            </div>
                            <div><label for="cau1_xanh"><input type="radio" name="checkbox" value="value" id="cau1_xanh" class="largerCheckbox"><strong> a. </strong>Xanh</label></div>
                            <div><label for="cau1_xanh1"><input type="radio" name="checkbox" value="value" id="cau1_xanh1" class="largerCheckbox"><strong> b. </strong>Đổ</label></div>
                            <div><label for="cau1_xanh2"><input type="radio" name="checkbox" value="value" id="cau1_xanh2" class="largerCheckbox"><strong> c. </strong>Tím</label></div>
                            <div><label for="cau1_xanh3"><input type="radio" name="checkbox" value="value" id="cau1_xanh3" class="largerCheckbox"><strong> d. </strong>Vàng</label></div>
                         </tr>
                         <tr>
                            <div class="form-group">
                                <div><strong>Câu 1 : </strong>Màu dây <strong>Trắng - Đỏ</strong> ký hiệu là gì ?</div>
                                <div> <img src="{{ asset('public/assets/frontend/images/anh-mau-day/trang-do.png') }}" alt="" width="200" /></div>
                            </div>
                            <div><label for="cau2_xanh"><input type="radio" name="checkbox1" value="value" id="cau2_xanh" class="largerCheckbox"><strong> a. </strong>Xanh</label></div>
                            <div><label for="cau2_xanh1"><input type="radio" name="checkbox1" value="value" id="cau2_xanh1" class="largerCheckbox"><strong> b. </strong>Đổ</label></div>
                            <div><label for="cau2_xanh2"><input type="radio" name="checkbox1" value="value" id="cau2_xanh2" class="largerCheckbox"><strong> c. </strong>Tím</label></div>
                            <div><label for="cau2_xanh3"><input type="radio" name="checkbox1" value="value" id="cau2_xanh3" class="largerCheckbox"><strong> d. </strong>Vàng</label></div>
                         </tr>
                         <tr>
                            <div class="form-group">
                                <div><strong>Câu 1 : </strong>Màu dây <strong>Trắng - Đỏ</strong> ký hiệu là gì ?</div>
                                <div> <img src="{{ asset('public/assets/frontend/images/anh-mau-day/trang-do.png') }}" alt="" width="200" /></div>
                            </div>
                            <div><label for="cau3_xanh"><input type="radio" name="checkbox2" value="value" id="cau3_xanh" class="largerCheckbox"><strong> a. </strong>Xanh</label></div>
                            <div><label for="cau3_xanh1"><input type="radio" name="checkbox2" value="value" id="cau3_xanh1" class="largerCheckbox"><strong> b. </strong>Đổ</label></div>
                            <div><label for="cau3_xanh2"><input type="radio" name="checkbox2" value="value" id="cau3_xanh2" class="largerCheckbox"><strong> c. </strong>Tím</label></div>
                            <div><label for="cau3_xanh3"><input type="radio" name="checkbox2" value="value" id="cau3_xanh3" class="largerCheckbox"><strong> d. </strong>Vàng</label></div>
                         </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </main>
@endsection
