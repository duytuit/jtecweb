<!-- ============================================================== -->
<!-- Top Show Data of List Exam -->
<!-- ============================================================== -->
<div class="row mt-1 fs-16 font-times-new">
    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xlg-6">
        <div class="card card-hover">
            <div class="box bg-info text-center">
                <div class="bg-yellow">
                    @php
                        $month = substr($item, 0, strlen($item) - 4);
                        $year = substr($item, -4);
                        $formattedDate = $month . '/' . $year;
                    @endphp
                    <div class="text-white">Kết quả lần <b>1</b> tháng <b>{{ $formattedDate }}</b></div>
                    <div class="text-white" style="display: flex;
                        justify-content: space-around;">
                        <div>
                            <div>Tổng</div>
                            <div>
                                {{ count($emp_pass_1) + count($emp_fail_1_90_95) + count($emp_fail_1_90) + count($emp_yet_1) }}
                            </div>
                        </div>
                        <div>
                            <div>Đạt</div>
                            <div><a href="javascript:;" class="btn-sm btn-warning detailReport"
                                    data-emp="{{ json_encode($emp_pass_1) }}" data-type="1"
                                    style="color: white">{{ count($emp_pass_1) }}</a></div>
                        </div>
                        <div>
                            <div>Chưa đạt</div>
                            <div>
                                <table class="table-bordered">
                                    <tr>
                                        <td style="padding: 0 10px">
                                            Thi lại
                                        </td>
                                        <td style="padding: 0 10px">
                                            Đào tạo lại
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 5px 0px">
                                            <div><a href="javascript:;" class="btn-sm btn-warning detailReport"
                                                    data-emp="{{ json_encode($emp_fail_1_90_95) }}" data-type="2"
                                                    style="color: white">{{ count($emp_fail_1_90_95) }}</a></div>
                                        </td>
                                        <td style="padding: 5px 0px">
                                            <div><a href="javascript:;" class="btn-sm btn-warning detailReport"
                                                    data-emp="{{ json_encode($emp_fail_1_90) }}" data-type="3"
                                                    style="color: white">{{ count($emp_fail_1_90) }}</a></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div>Chưa thi</div>
                            <div><a href="javascript:;" class="btn-sm btn-warning detailReport"
                                    data-emp="{{ json_encode($emp_yet_1) }}" data-type="4"
                                    style="color: white">{{ count($emp_yet_1) }}</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xlg-6">
        <div class="card card-hover">
            <div class="box bg-info text-center">
                <div class="bg-yellow">
                    <div class="text-white">Kết quả lần <b>2</b> tháng <b>{{ $formattedDate }}</b></div>
                    <div class="text-white"
                        style="display: flex;
                        justify-content: space-around;">
                        <div>
                            <div>Tổng</div>
                            <div>
                                {{ count($emp_pass_2) + count($emp_fail_2_90_95) + count($emp_fail_2_90) + count($emp_yet_2) }}
                            </div>
                        </div>
                        <div>
                            <div>Đạt</div>
                            <div><a href="javascript:;" class="btn-sm btn-warning detailReport"
                                    data-emp="{{ json_encode($emp_pass_2) }}" data-type="5"
                                    style="color: white">{{ count($emp_pass_2) }}</a></div>
                        </div>
                        <div>
                            <div>Chưa đạt</div>
                            <div>
                                <table class="table-bordered">
                                    <tr>
                                        <td style="padding: 0 10px">
                                            Thi lại
                                        </td>
                                        <td style="padding: 0 10px">
                                            Đào tạo lại
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 5px 0px">
                                            <div><a href="javascript:;" class="btn-sm btn-warning detailReport"
                                                    data-emp="{{ json_encode($emp_fail_2_90_95) }}" data-type="6"
                                                    style="color: white">{{ count($emp_fail_2_90_95) }}</a></div>
                                        </td>
                                        <td style="padding: 5px 0px">
                                            <div><a href="javascript:;" class="btn-sm btn-warning detailReport"
                                                    data-emp="{{ json_encode($emp_fail_2_90) }}" data-type="7"
                                                    style="color: white">{{ count($emp_fail_2_90) }}</a></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div>Chưa thi</div>
                            <div><a href="javascript:;" class="btn-sm btn-warning detailReport"
                                    data-emp="{{ json_encode($emp_yet_2) }}" data-type="8"
                                    style="color: white">{{ count($emp_yet_2) }}</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
