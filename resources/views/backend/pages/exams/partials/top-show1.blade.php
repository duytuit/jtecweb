<!-- ============================================================== -->
<!-- Top Show Data of List Exam -->
<!-- ============================================================== -->
<div class="row mt-1 mb-2 p-1 fs-16 font-times-new bg-info  container-fluid mx-auto rounded">
    <!-- Column -->
    <div class="w-100">
        <div class="card col-md-6 bg-info col-lg-6 col-xlg-6 m-auto border border-light rounded">
            <div class="box text-center">
                <div class="bg-yellow">
                    @php
                        $month = substr($cycleName, 0, 2);
                        $year = substr($cycleName, 2);
                        $formattedDate = $month . '/' . $year;
                    @endphp
                    <div class="text-white">Kết quả lần <b>1</b> tháng <b>{{ $formattedDate }}</b></div>
                    <div class="text-white" style="display: flex;
                        justify-content: space-around;">
                        <div>
                            <div>Tổng</div>
                            <div>
                                {{ count($emp_pass_1) + count($emp_fail_1_60_79) + count($emp_fail_1_50_59) + count($emp_fail_1_49) }}
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
                                                    data-emp="{{ json_encode($emp_fail_1_50_59) }}" data-type="2"
                                                    style="color: white">{{ count($emp_fail_1_50_59) }}</a></div>
                                        </td>
                                        <td style="padding: 5px 0px">
                                            <div><a href="javascript:;" class="btn-sm btn-warning detailReport"
                                                    data-emp="{{ json_encode($emp_fail_1_60_79) }}" data-type="3"
                                                    style="color: white">{{ count($emp_fail_1_60_79) }}</a></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
