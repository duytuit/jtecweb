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
                <input name="type" type="hidden" value="{{ Request::query('type') }}">
                <div>
                    <div>
                        <strong style=" text-transform: uppercase;">Bài kiểm tra kiến thức công nhân mới</strong>
                    </div>
                </div>
                <div>
                    <div>
                        <strong>Tiêu chuẩn đánh giá</strong><br>
                        <i>(Thang điểm : 100 điểm)</i>
                    </div>
                    <i>Điểm đạt: 80->100 điểm</i><br>
                    <i>Từ 60->80 điểm: kiểm tra lại sau 2 ngày (nếu không đạt sẽ được đào tạo lại)</i><br>
                    <i>Từ 50->59 điểm: Đào tạo lại 1 tuần và kiểm tra lại </i><br>
                    <i>Dưới 50 điểm: Không đạt </i><br>
                    <i>Thời gian làm bài <strong>05:00</strong></i><br>
                </div>
                <div>
                    <div>
                        Công đoạn:
                    </div>
                    <div>
                        <select class="form-control" name="congdoan">
                            <option value="1" selected>Cắm</option>
                        </select>
                    </div>
                    <div>
                        Mã nhân viên:
                    </div>
                    <div>
                        <input type="text" name="manhanvien" value="{{ Request::query('code') }}" class="form-control"
                            readonly>
                    </div>
                    <div>
                        Ngày kiểm tra:
                    </div>
                    <div class="form-group">
                        <input type="date" id="datePicker" name="ngaykiemtra" value="{{ time() }}"
                            class="form-control" style="width:100%">
                        <input type="hidden" id="count_timer" name="count_timer" value="{{ date('Y-m-d H:i:s') }}">
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-secondary font-weight-bold examSubmit">Nộp bài</button>
                </div>
                @php
                    $groupQuestion = App\Helpers\ArrayHelper::groupQuestion();
                    foreach ($groupQuestion as &$group) {
                        shuffle($group['question']);
                    }

                    // Nhóm câu hỏi 1
                    $names1 = $groupQuestion[0]['groupname'];
                    $array_exam1 = $groupQuestion[0]['question'];
                    $array_quantity1 = $groupQuestion[0]['quantity_question'];
                    $array_exam1 = array_slice($array_exam1, 0, $array_quantity1); // Số lượng câu hỏi

                    // Nhóm câu hỏi 2
                    $names2 = $groupQuestion[1]['groupname'];
                    $array_exam2 = $groupQuestion[1]['question'];
                    $array_quantity2 = $groupQuestion[1]['quantity_question'];
                    $array_exam2 = array_slice($array_exam2, 0, $array_quantity2); // Số lượng câu hỏi
                @endphp

                <div class="cards map_question">
                    <div>
                        <div class="px-3 d-flex flex-wrap">
                            <div class="d-flex flex-wrap">
                                @foreach ($array_exam1 as $index => $item)
                                    <a href="javascript:;" id="label_{{ $item['id'] }}" class="map_item"
                                        data-id="{{ $item['id'] }}" data-value="{{ $item['answer'] }}"
                                        onclick="getMapQuestion({{ $item['id'] }})">
                                        {{ $index + 1 }}
                                    </a>
                                @endforeach
                            </div>
                            <div class="d-flex flex-wrap">
                                @foreach ($array_exam2 as $index => $item)
                                    <a href="javascript:;" id="label_{{ $item['id'] }}" class="map_item"
                                        data-id="{{ $item['id'] }}" data-value="{{ $item['answer'] }}"
                                        onclick="getMapQuestion({{ $item['id'] }})">
                                        {{ $index + 1 }}
                                    </a>
                                @endforeach
                            </div>
                            @foreach (array_slice($groupQuestion, 2) as $array_exam_index)
                                @php
                                    $array_quantity = $array_exam_index['quantity_question'];
                                    $array_exam = $array_exam_index['question'];
                                    $array_exam = array_slice($array_exam, 0, $array_quantity);
                                @endphp
                                <div class="d-flex flex-wrap">
                                    @foreach ($array_exam as $index => $item)
                                        <a href="javascript:;" id="label_{{ $item['id'] }}" class="map_item"
                                            data-id="{{ $item['id'] }}" data-value="{{ $item['answer'] }}"
                                            onclick="getMapQuestion({{ $item['id'] }})">
                                            {{ $index + 1 }}
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- start group question 1 --}}
                <strong class="px-3 d-inline-block">{{ $names1 }}</strong>
                <div class="cards">
                    @foreach ($array_exam1 as $index => $item)
                        <div class="cards_item" id="{{ $item['id'] }}">
                            <div class="card_question">
                                <div class="form-group">
                                    <div><strong>Câu {{ $index + 1 }} :
                                        </strong><strong>{{ $item['show_question'] == 1 ? $item['name'] : '' }}</strong>
                                    </div>
                                    <div> <img src="{{ asset($item['path_image']) }}" alt="" width="200" />
                                    </div>
                                </div>
                                @php
                                    $array_Answer = $item['answer_list'];
                                    $firstThree = array_slice($array_Answer, 0, 3);
                                    shuffle($firstThree);
                                    for ($i = 0; $i < 3; $i++) {
                                        $array_Answer[$i] = $firstThree[$i];
                                    }
                                @endphp
                                <div>
                                    @foreach ($array_Answer as $index1 => $item1)
                                        <div @if ($item['answer'] == $item1) class="right_answer" @endif>
                                            <label for="cau__{{ $item['id'] }}_answer_{{ $index1 }}"><input
                                                    type="radio" value="{{ $item1 }}"
                                                    onclick="getCheck({{ $item['id'] }})"
                                                    name="answer[{{ $item['id'] }}]"
                                                    id="cau__{{ $item['id'] }}_answer_{{ $index1 }}"
                                                    class="largerCheckbox">
                                                <strong> {{ $index1 + 1 }}. </strong>{{ $item1 }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- End group question 1 --}}

                {{-- start group question 2 --}}
                <strong class="px-3 d-inline-block">{{ $names2 }}</strong>
                <div class="cards d-block">
                    @foreach ($array_exam2 as $index => $item)
                        <div class="cards_item w-100" id="{{ $item['id'] }}">
                            <div class="card_question w-100">
                                <div class="form-group">
                                    <div><strong>Câu {{ $index + 1 }} :</strong>
                                        <strong>{{ $item['show_question'] == 1 ? $item['name'] : '' }}</strong>
                                    </div>
                                </div>
                                @php
                                    $array_Answer = $item['answer_list'];
                                    shuffle($array_Answer);
                                @endphp
                                <div class="d-flex justify-content-between flex-wrap">
                                    @foreach ($array_Answer as $index1 => $item1)
                                        <div @if ($item['answer'] == $item1) class="right_answer" @endif>
                                            <label for="cau__{{ $item['id'] }}_answer_{{ $index1 }}">
                                                <input type="radio" value="{{ $item1 }}"
                                                    onclick="getCheck({{ $item['id'] }})"
                                                    name="answer[{{ $item['id'] }}]"
                                                    id="cau__{{ $item['id'] }}_answer_{{ $index1 }}"
                                                    class="largerCheckbox">
                                                <strong> {{ $index1 + 1 }}. </strong>
                                                <div> <img src="{{ asset($item1) }}" alt="" width="200" />
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- end Question 2 --}}


                @foreach (array_slice($groupQuestion, 2) as $questionItem)
                    @php
                        $names = $questionItem['groupname'];
                        $array_exam = $questionItem['question'];
                        $array_quantity = $questionItem['quantity_question'];
                        $array_exam = array_slice($array_exam, 0, $array_quantity); // Số lượng câu hỏi
                    @endphp
                    <strong class="px-3 d-inline-block">{!! $names !!}</strong>
                    <div class="cards d-block">
                        @foreach ($array_exam as $index => $item)
                            <div class="cards_item w-100" id="{{ $item['id'] }}">
                                <div class="card_question">
                                    <div class="form-group">
                                        <div><strong>Câu {{ $index + 1 }} :
                                            </strong>
                                            <strong>{!! $item['show_question'] == 1 ? $item['name'] : '' !!}</strong>
                                        </div>
                                    </div>
                                    @php
                                        $array_Answer = $item['answer_list'];
                                        $firstThree = array_slice($array_Answer, 0, 3);
                                        shuffle($firstThree);
                                        for ($i = 0; $i < 3; $i++) {
                                            $array_Answer[$i] = $firstThree[$i];
                                        }
                                    @endphp
                                    <div>
                                        @foreach ($array_Answer as $index1 => $item1)
                                            <div @if ($item['answer'] == $item1) class="right_answer" @endif>
                                                <label for="cau__{{ $item['id'] }}_answer_{{ $index1 }}">
                                                    <input type="radio" value="{{ $item1 }}"
                                                        onclick="getCheck({{ $item['id'] }})"
                                                        name="answer[{{ $item['id'] }}]"
                                                        id="cau__{{ $item['id'] }}_answer_{{ $index1 }}"
                                                        class="largerCheckbox">
                                                    <strong> {{ $index1 + 1 }}. </strong>
                                                    {{ $item1 }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

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
    <script src="{{ asset('public/assets/frontend/js/confetti.browser.min.js') }}"></script>
    <script>
        $(".abc123").click(function() {
            swal("Chúc mừng bạn đã đạt: 100");
        });

        function getCheck(params) {
            $("#label_" + params).css("background-color", "blueviolet")
        }

        function getMapQuestion(id) {
            console.log(id);
            $('html, body').animate({
                scrollTop: $("#" + id).offset().top
            }, 1000);
            $(".cards_item").css("background-color", "transparent")
            $("#" + id).css("background-color", "#dee2e6")
        }
        $('.examSubmit').click(function(e) {
            e.preventDefault();
            // console.log($(this).text());
            if ($(this).text() == "Nộp bài") {
                submit_exam()
            } else {
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
            var values = $('#examForm').serialize()
            console.log(values);
            $.ajax({
                url: "{{ route('exam.storeNew') }}",
                method: 'POST',
                data: values,
                success: function(data) {
                    // if(data?.warning){
                    //     alert(data?.warning);
                    //     location.reload();
                    // }
                    $('.examSubmit').html('Làm lại');
                    $('.map_question a').each(function(i, obj) {
                        var member_answer = $('input[name="answer[' + $(this).data('id') +
                            ']"]:checked').val()
                        if (member_answer) {
                            if (member_answer != $(this).data('value')) {
                                $(this).css("background-color", "red")
                                $('input[name="answer[' + $(this).data('id') + ']"]:checked').css({
                                    "accent-color": "red"
                                })
                                $('input[name="answer[' + $(this).data('id') + ']"]:checked').parent()
                                    .css({
                                        "color": "red"
                                    })
                            } else {
                                $(this).css("background-color", "blue")
                            }
                        }
                    });
                    if (data.status == "success") {
                        $(".right_answer").css("color", "blue");
                        var scores = data.exam.scores;
                        if (scores > 1) {
                            swal("Bạn đã đạt: " + scores + "điểm");
                            swal("Bạn đã đạt: " + scores + "điểm \n CHÚC MỪNG BẠN ĐÃ HOÀN THÀNH BÀI TEST");
                            // confetti({
                            //     particleCount: 150,
                            //     spread: 60,
                            //     zIndex: 999999
                            // });

                            var duration = 5 * 1000;
                            var animationEnd = Date.now() + duration;
                            var defaults = {
                                startVelocity: 30,
                                spread: 360,
                                ticks: 60,
                                zIndex: 999999
                            };

                            function randomInRange(min, max) {
                                return Math.random() * (max - min) + min;
                            }

                            var interval = setInterval(function() {
                                var timeLeft = animationEnd - Date.now();

                                if (timeLeft <= 0) {
                                    return clearInterval(interval);
                                }

                                var particleCount = 50 * (timeLeft / duration);
                                // since particles fall down, start a bit higher than random
                                confetti({
                                    ...defaults,
                                    particleCount,
                                    origin: {
                                        x: randomInRange(0.1, 0.3),
                                        y: Math.random() - 0.2
                                    }
                                });
                                confetti({
                                    ...defaults,
                                    particleCount,
                                    origin: {
                                        x: randomInRange(0.7, 0.9),
                                        y: Math.random() - 0.2
                                    }
                                });
                            }, 50);
                        } else {
                            swal("Số điểm của bạn là: " + scores + ". Bạn chưa đạt");
                        }
                    }
                }
            });
        }

        function tick() {
            var secs = timeInSecs;
            if (secs > 0) {
                timeInSecs--;
            } else {
                clearInterval(ticker);
                if ($('.examSubmit').first().text() == "Nộp bài") {
                    submit_exam()
                }
                //submit_exam()
                //$(".examSubmit").trigger('click');
                //startTimer(1*60); // 4 minutes in seconds
            }

            var mins = Math.floor(secs / 60);
            secs %= 60;
            var pretty = ((mins < 10) ? "0" : "") + mins + ":" + ((secs < 10) ? "0" : "") + secs;
            document.getElementById("countdown").innerHTML = pretty;
        }

        startTimer(10 * 60); // 4 minutes in seconds
    </script>
@endsection
