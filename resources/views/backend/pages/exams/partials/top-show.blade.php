
<!-- ============================================================== -->
<!-- Top Show Data of List Exam -->
<!-- ============================================================== -->
<div class="row mt-1">
    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xlg-6" >
        <div class="card card-hover">
            <div class="box bg-info text-center">
                <div class="bg-yellow">
                    <div class="font-light text-white"><strong>Kết quả lần <strong>1</strong> tháng hiện tại</strong></div>
                    <div class="text-white" style="display: flex;
                        justify-content: space-around;">
                         <div>
                             <div>Tổng</div>
                             <div>{{count($emp)}}</div>
                         </div>
                         <div>
                            <div>Đạt</div>
                            <div>{{count($emp_pass_1)}}</div>
                        </div>
                         <div>
                            <div>Chưa đạt</div>
                            <div>{{count($emp_fail_1)}}</div>
                        </div>
                         <div>
                            <div>Chưa thi</div>
                            <div>{{count($emp_yet_1)}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xlg-6" >
        <div class="card card-hover">
            <div class="box bg-info text-center">
                <div class="bg-yellow">
                    <div class="font-light text-white">Kết quả lần <strong>2</strong> tháng hiện tại</div>
                    <div class="text-white" style="display: flex;
                        justify-content: space-around;">
                         <div>
                             <div>Tổng</div>
                             <div>{{count($emp)}}</div>
                         </div>
                         <div>
                            <div>Đạt</div>
                            <div>{{count($emp_pass_2)}}</div>
                        </div>
                         <div>
                            <div>Chưa đạt</div>
                            <div>{{count($emp_fail_2)}}</div>
                        </div>
                         <div>
                            <div>Chưa thi</div>
                            <div>{{count($emp_yet_2)}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
