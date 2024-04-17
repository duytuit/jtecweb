@extends('backend.layouts.master')

@section('admin-content')
    <div class="tension-container">
        <div class="tension">
            <div class="head">
                <h1 class="title">NHẬP DỮ LIỆU SỨC CĂNG</h1>
                <img src="/public/assets/images/logo/logo.png" alt="" class="tension-logo">
            </div>
            <div class="computer">
                <span class="text">TÊN MÁY TÍNH</span>
                <select id="selectComputer" name="selectComputer" class="computer-select"
                    aria-label="Default select example">
                    <option value="MT-N013" selected>MT-N013</option>
                    <option value="MT-N014">MT-N014</option>
                    <option value="MT-N037">MT-N037</option>
                    <option value="MT-N038">MT-N038</option>
                    <option value="MT-N039">MT-N039</option>
                    <option value="MT-N040">MT-N040</option>
                </select>
                <button class="btn btn-reset">
                    <img src="/public/assets/images/pages/tension/reset.png" alt="" class="tension-logo">
                    <span>Reset</span>
                </button>
                <button class="btn btn-save">
                    <span>Lưu dữ liệu</span>
                </button>
                <button class="btn btn-export">
                    <span>Xem - Xuất</span>
                </button>
            </div>
            <div class="tension-content">
                <table>
                    <thead>
                        <tr>
                            <th class="clb">Chủng loại B</th>
                            <th>Kích cỡ dây</th>
                            <th class="tt-tc">Tải trọng TC<br>(Kg)</th>
                            <th class="tt-dd">Tải trọng DD</th>
                            <th class="visible-hide border-0">11111</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.25</td>
                            <td>0.5</td>
                            <td>&gt;=9</td>
                            <td class="bgc-C0FFC0 py-0">
                                <input class="input-text" type="text">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>0.85</td>
                            <td>&gt;=15</td>
                            <td class="bgc-C0FFFF">
                                <input class="input-text" type="text">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>5.5</td>
                            <td>2</td>
                            <td>&gt;=29</td>
                            <td class="bgc-C0C0FF">
                                <input class="input-text" type="text">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td rowspan="2" class="border-right-0"><strong>Áp lực khí:</strong></td>
                            <td rowspan="2" class="border-left-0">0.55~0.65Mpa</td>
                            <td class="border-bottom-0 pb-0">
                                <input type="radio" id="checkOk" name="checkOk" value="">
                                <label for="checkOk">OK</label>
                            </td>
                            <td colspan="2" rowspan="2">
                                <textarea class="note" name="note" id=""></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-top-0">
                                <input type="radio" id="checkNg" name="checkNg" value="">
                                <label for="checkNg">NG</label>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection
