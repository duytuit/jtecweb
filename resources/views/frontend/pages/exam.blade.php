@extends('frontend.layouts.master')

@section('title')
    {{ config('app.name') }} | {{ config('app.description') }}
@endsection

@section('main-content')
    <main class="main">
        <!-- Page Content -->
        <div class="container">
            <form id="examForm">
                        {{-- <a href="javascript:;" class="abc123">test</a> --}}
                         <div>
                            <div>
                                <strong style=" text-transform: uppercase;">Bài kiểm tra năng lực nhận biết màu dây</strong>
                            </div>
                        </div>
                         <div>
                            <div>
                                <strong>Tiêu chuẩn đánh giá</strong>
                            </div>
                            <i>Điểm đạt: 96->100 điểm</i><br>
                            <i>Từ 90->95 điểm: kiểm tra lại sau 2 ngày (nếu không đạt sẽ được đào tạo lại)</i><br>
                            <i>Dưới 90 điểm: Không đạt ( đào tạo lại màu dây 1 tuần)</i><br>
                            <i>Thời gian làm bài <strong>05:00</strong></i><br>
                         </div>
                         <div>
                            <div>
                               Công đoạn:
                            </div>
                            <div>
                                <select class="form-control" name="congdoan">
                                    <option value="1" selected >Cắm</option>
                                </select>
                            </div>
                            <div>
                                Mã nhân viên:
                             </div>
                             <div>
                                 <input type="text" name="manhanvien" value="{{Request::query('code')}}" class="form-control" readonly>
                             </div>
                             <div>
                                Ngày kiểm tra:
                             </div>
                             <div class="form-group">
                                 <input type="date" id="datePicker" name="ngaykiemtra" value="{{time()}}" class="form-control" style="width:100%">
                                 <input type="hidden" id="count_timer" name="count_timer" value="{{date('Y-m-d H:i:s')}}">
                                </div>
                         </div>
                        <div class="form-group">
                            <button class="btn btn-secondary font-weight-bold examSubmit">Nộp bài</button>
                        </div>
                        @php
                            $array_exam = App\Helpers\ArrayHelper::arrayExamPd();
                            shuffle($array_exam);
                        @endphp
                        <div class="cards map_question">
                            @foreach ($array_exam as $index => $item)
                                <a href="javascript:;" id="label_{{$item['id']}}" class="map_item" data-id="{{$item['id']}}" data-value="{{$item['answer']}}" onclick="getMapQuestion({{$item['id']}})">
                                    {{$index +1}}
                                </a>
                            @endforeach
                        </div>
                        <strong>Bạn hãy chọn đáp án đúng bằng cách tích vào ô có <u>ký hiệu</u> tương ứng với màu dây:</strong>
                        <div class="cards">
                            @foreach ($array_exam as $index => $item)
                            <div class="cards_item" id="{{$item['id']}}">
                                <div class="card_question">
                                    <div class="form-group">
                                        <div><strong>Câu {{$index +1}} : </strong><strong>{{$item['show_question'] == 1 ? $item['name']:''}}</strong></div>
                                        <div> <img src="{{ asset($item['path_image']) }}" alt="" width="200" /></div>
                                    </div>
                                    @php
                                        $array_Answer =  $item['answer_list'];
                                        shuffle($array_Answer);
                                    @endphp
                                    <div>
                                        @foreach ( $array_Answer as $index1 =>$item1 )
                                                <div @if ($item['answer'] == $item1) class="right_answer" @endif><label for="cau__{{$item['id']}}_answer_{{$index1}}"><input type="radio" value="{{$item1}}" onclick="getCheck({{$item['id']}})" name="answer[{{$item['id']}}]"  id="cau__{{$item['id']}}_answer_{{$index1}}" class="largerCheckbox"><strong> {{$index1+1}}. </strong> {{$item1}}</label></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <div class="form-group">
                            <button class="btn btn-secondary font-weight-bold examSubmit">Nộp bài</button>
                        </div>
            </form>
        </div>
        <div class="time_count_down">
             <div id="countdown">
             </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        $(".abc123").click(function() {
            swal("Chúc mừng bạn đã đạt: 100");
        });
        function getCheck(params) {
            $("#label_"+params).css("background-color","blueviolet")
        }
        function getMapQuestion(id){
                console.log(id);
                $('html, body').animate({
                    scrollTop: $("#"+id).offset().top
                }, 1000);
                $(".cards_item").css("background-color","transparent")
                $("#"+id).css("background-color","#dee2e6")
        }
        $('.examSubmit').click(function(e) {
            e.preventDefault();
            // console.log($(this).text());
            if($(this).text() == "Nộp bài"){
                submit_exam()
            }else{
                location.reload();
            }
        });
        document.getElementById('datePicker').valueAsDate = new Date();
        var timeInSecs;
        var ticker;
        function startTimer(secs) {
            timeInSecs = parseInt(secs);
            ticker = setInterval("tick()", 1000);
        }

        function submit_exam() {
            console.log('đã đóng');
            $('.examSubmit').prop("disabled", true);
            setTimeout(() => {
                $('.examSubmit').prop('disabled', false);
                console.log('đã mở');
            }, 2000)
            // Get all the forms elements and their values in one step
            var values =   $('#examForm').serialize()
            console.log(values);
            $.ajax({
                url: "{{ route('exam.store') }}",
                method: 'POST',
                data: values,
                success: function(data){
                    // if(data?.warning){
                    //     alert(data?.warning);
                    //     location.reload();
                    // }
                    $('.examSubmit').html('Làm lại');
                    $('.map_question a').each(function(i, obj) {
                        var member_answer = $('input[name="answer['+$(this).data('id')+']"]:checked').val()
                        if(member_answer){
                            if(member_answer != $(this).data('value')){
                                $(this).css("background-color","red")
                                $('input[name="answer['+$(this).data('id')+']"]:checked').css({"accent-color":"red"})
                                $('input[name="answer['+$(this).data('id')+']"]:checked').parent().css({"color":"red"})
                            }else{
                                $(this).css("background-color","blue")
                            }
                        }
                    });
                    if(data.status == "success"){

                        $(".right_answer").css("color", "blue");
                        var results = Math.round(( data.exam.results/data.exam.total_questions)*100) ;
                        if(results > 79){
                            swal("Chúc mừng bạn đã đạt: "+results);
                        }else{
                            swal("Số điểm của bạn là: "+results+". Bạn chưa đạt");
                        }
                    }
                }
            });
        }

        function tick() {
            var secs = timeInSecs;
            if (secs > 0) {
                timeInSecs--;
            }
            else {
                clearInterval(ticker);
                if($('.examSubmit').first().text() == "Nộp bài"){
                    submit_exam()
                }
                //submit_exam()
                //$(".examSubmit").trigger('click');
                //startTimer(1*60); // 4 minutes in seconds
            }

            var mins = Math.floor(secs/60);
            secs %= 60;
            var pretty = ( (mins < 10) ? "0" : "" ) + mins + ":" + ( (secs < 10) ? "0" : "" ) + secs;
            document.getElementById("countdown").innerHTML = pretty;
        }

        startTimer(4.9*60); // 4 minutes in seconds
    </script>
@endsection
