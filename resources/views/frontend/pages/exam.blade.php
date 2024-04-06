@extends('frontend.layouts.master')

@section('title')
    {{ config('app.name') }} | {{ config('app.description') }}
@endsection

@section('main-content')
    <main class="main">
        <!-- Page Content -->
        <div class="container">
            <form id="examForm">

                         <div>
                            <div>
                                <strong style=" text-transform: uppercase;">Bài kiểm tra năng lực nhận biết màu dây</strong>
                            </div>
                        </div>
                         <div>
                            <i>Điểm đạt: 80-100</i><br>
                            <i>Từ 50->79 điểm: kiểm tra lại sai 2 ngày (nếu không đạt sẽ được đào tạo lại)</i><br>
                            <i>Dưới 50 điểm: Không đạt ( đào tạo lại màu dây 1 tuần)</i><br>
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
                             <div class="form-group">
                                 <input type="date" id="datePicker" name="ngaykiemtra" value="{{time()}}" class="form-control" style="width:100%">
                             </div>
                         </div>
                        <div class="form-group">
                            <button class="btn btn-secondary font-weight-bold examSubmit">Nộp bài</button>
                        </div>
                        @php
                            $array_exam = App\Helpers\ArrayHelper::arrayExamPd();
                            shuffle($array_exam);
                        @endphp
                        <strong>Bạn hãy chọn đáp án đúng bằng cách tích vào ô có <u>ký hiệu</u> tương ứng với màu dây:</strong>
                        <div class="cards">
                            @foreach ($array_exam as $index => $item)
                            <div class="cards_item">
                                <div class="card_question">
                                    <div class="form-group">
                                        <div><strong>Câu {{$index +1}} : </strong><strong>{{$item['name']}}</strong></div>
                                        <div> <img src="{{ asset($item['path_image']) }}" alt="" width="200" /></div>
                                    </div>
                                    @php
                                        $array_Answer =  $item['answer_list'];
                                        shuffle($array_Answer);
                                    @endphp
                                    <div>
                                        @foreach ( $array_Answer as $index1 =>$item1 )
                                                <div @if ($item['answer'] == $item1) class="right_answer" @endif><label for="cau__{{$item['id']}}_answer_{{$index1}}"><input type="radio" value="{{$item1}}" name="answer[{{$item['id']}}]"  id="cau__{{$item['id']}}_answer_{{$index1}}" class="largerCheckbox"><strong> {{$index1+1}}. </strong> {{$item1}}</label></div>
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
        $('.examSubmit').click(function(e) {
            e.preventDefault();
            console.log($(this).text());
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
                    $('.examSubmit').html('Làm lại');
                    if(data.status == "success"){
                        $(".right_answer").css("color", "blue");
                        var results =Math.round(( data.exam.results/data.exam.total_questions)*100) ;
                    if(results > 79){
                        alert("Chúc mừng bạn đã đạt: "+results);
                    }else{
                        alert("Số điểm của bạn là: "+results+". Bạn chưa đạt");
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

        startTimer(60); // 4 minutes in seconds
    </script>
@endsection
