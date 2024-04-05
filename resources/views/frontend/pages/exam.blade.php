@extends('frontend.layouts.master')

@section('title')
    {{ config('app.name') }} | {{ config('app.description') }}
@endsection

@section('main-content')
    <main class="main">
        <!-- Page Content -->
        <div class="container">
            <form id="examForm">
                <table style="width: 100%; padding: 10px">
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
                             <div class="form-group">
                                 <input type="date" name="ngaykiemtra" class="form-control" style="width:100%">
                             </div>
                         </tr>
                    </thead>
                    <tbody>
                        <div class="form-group">
                            <a href="javascript:;" class="btn btn-secondary font-weight-bold examSubmit">Nộp bài</a>
                        </div>
                        @php
                            $array_exam = App\Helpers\ArrayHelper::arrayExamPd();
                            shuffle($array_exam);
                        @endphp
                        @foreach ($array_exam as $index => $item)
                            <tr>
                                <div class="form-group">
                                    <div><strong>Câu {{$index +1}} : </strong>Màu dây <strong>{{$item['name']}}</strong> ký hiệu là gì ?</div>
                                    <div> <img src="{{ asset($item['path_image']) }}" alt="" width="200" /></div>
                                </div>
                                @php
                                    $array_Answer = App\Helpers\ArrayHelper::mixAnswerInArray($item['answer']);
                                @endphp
                                @foreach ( $array_Answer as $index1 =>$item1 )
                                     <div><label for="cau__{{$item['id']}}_answer_{{$index1}}"><input type="radio" value="{{$item1}}" name="cau_{{$item['id']}}"  id="cau__{{$item['id']}}_answer_{{$index1}}" class="largerCheckbox"><strong> {{$index1+1}}. </strong> {{$item1}}</label></div>
                                @endforeach
                            </tr>
                        @endforeach
                        <div class="form-group">
                            <a href="javascript:;" class="btn btn-secondary font-weight-bold examSubmit">Nộp bài</a>
                        </div>
                    </tbody>
                </table>
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
                console.log(data);
            }
          });
        });
    </script>
@endsection
