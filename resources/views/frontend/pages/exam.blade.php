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
                            <i>Thời gian còn lại là: <strong>01:00</strong></i><br>
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
                                 <input type="date" name="ngaykiemtra" class="form-control" style="width:100%">
                             </div>
                         </div>
                        <div class="form-group">
                            <a href="javascript:;" class="btn btn-secondary font-weight-bold examSubmit">Nộp bài</a>
                        </div>
                        @php
                            $array_exam = App\Helpers\ArrayHelper::arrayExamPd();
                            shuffle($array_exam);
                        @endphp
                        <strong>Bạn hãy chọn đáp án đúng bằng cách tích vào ô có <u>ký hiệu</u> tương ứng với màu dây:</strong>
                        <div class="data_list">
                            @foreach ($array_exam as $index => $item)
                            <div>
                                <div class="form-group">
                                    <div><strong>Câu {{$index +1}} : </strong><strong>{{$item['name']}}</strong></div>
                                    <div> <img src="{{ asset($item['path_image']) }}" alt="" width="200" /></div>
                                </div>
                                @php
                                    $array_Answer =  $item['answer_list'];
                                    shuffle($array_Answer);
                                @endphp
                                @foreach ( $array_Answer as $index1 =>$item1 )
                                     <div><label for="cau__{{$item['id']}}_answer_{{$index1}}"><input type="radio" value="{{$item1}}" name="answer[{{$item['id']}}]"  id="cau__{{$item['id']}}_answer_{{$index1}}" class="largerCheckbox"><strong> {{$index1+1}}. </strong> {{$item1}}</label></div>
                                @endforeach
                            </div>
                        @endforeach
                        </div>
                        <div class="form-group">
                            <a href="javascript:;" class="btn btn-secondary font-weight-bold examSubmit">Nộp bài</a>
                        </div>
            </form>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        $('.examSubmit').click(function(e) {
          e.preventDefault();
         // Get all the forms elements and their values in one step
          var values =   $('#examForm').serialize()
          console.log(values);
          $.ajax({
            url: "{{ route('exam.store') }}",
            method: 'POST',
            data: values,
            success: function(data){
                if(data.status == "success"){
                  var results =Math.round(( data.exam.results/data.exam.total_questions)*100) ;
                   if(results > 79){
                    alert("Chúc mừng bạn đã đạt: "+results);
                   }else{
                    alert("Số điểm của bạn là: "+results+". Bạn chưa đạt");
                   }

                }
            }
          });
        });
    </script>
@endsection
