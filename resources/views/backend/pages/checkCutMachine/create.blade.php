@extends('backend.layouts.master')

@section('admin-content')
    <div class="container-fluid ">
        <form action="{{ route('admin.requireds.requireCheckListMachineCut') }}" method="POST" data-parsley-validate
            data-parsley-focus="first">
            @csrf
            <div class="">
                <h1 class="title text-center ">BẢNG KIỂM TRA HÀNG NGÀY MÁY CẮT</h1>
                <div class="text-center font-20">
                    <strong>Bộ phận: </strong>
                    <select name="selecDepartment" class="department-select">
                        @foreach ($departments as $department)
                            <option {{ $departmentId == $department->id ? 'selected' : '' }} value="{{ $department->id }}">
                                {{ $department->name }}</option>
                        @endforeach
                    </select>

                    | <span>Máy: </span>
                    <select name="selecMachine" class="machine-select">
                        @foreach ($machineLists as $machineList)
                            <option value="{{ $machineList }}">{{ $machineList }}</option>
                        @endforeach
                    </select>
                    <br>
                    <span>Ngày làm việc: </span><strong>{{ date('d/m/Y') }}</strong><br>
                    @php
                        $auth = Auth::user();
                    @endphp
                    <span>Người thực hiện: </span><strong>{{ $auth->first_name . ' ' . $auth->last_name }}</strong>
                </div>
                <div class="row mb-2 ">
                    <div class="col-11 w-75 mx-auto p-md-2 fs-3">
                        <div class="row">
                            @foreach ($formTypeJobs as $index => $formTypeJob)
                                <div class="col-md-4 p-2 ">
                                    <div class="h-100 p-2 shadow-lg check-cut-machine">
                                        <span class="p-md-2 d-block bg-danger text-light">Vị trí
                                            {{ $formTypeJob['id'] + 1 }}</span>
                                        <div>
                                            <img style="height: 220px; object-fit: cover;object-position: top left;"
                                                class="w-100 mb-auto" src="{{ '../../' . $formTypeJob['image'] }}"
                                                alt="">
                                        </div>
                                        <div class="pt-2 ">
                                            <strong class="text-uppercase ">Vị trí kiểm tra:</strong>
                                            <p>{{ $formTypeJob['position'] }}</p>
                                            <strong class="text-uppercase ">Phương pháp kiểm tra:</strong>
                                            <p>{{ $formTypeJob['method'] }}</p>
                                            <strong class="text-uppercase ">Xử lý:</strong>
                                            <p>{{ $formTypeJob['handle'] }}</p>
                                            <strong class="text-uppercase ">Kết quả kiểm tra</strong><br>
                                            @foreach ($formTypeJob['answer_list'] as $index1 => $item)
                                                <input name="answer[{{ $index }}]"
                                                    id="answerId{{ $index . $index1 }}"
                                                    style="width:20px;height:20px; vertical-align: middle;" type="radio"
                                                    value="{{ $item }}"
                                                    data-parsley-required-message="Bạn chưa check list" required>
                                                <label
                                                    for="answerId{{ $index . $index1 }}">{{ $item == 0 ? 'Bất bình thường' : 'Bình thường' }}</label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-md-4 p-2 ">
                                <div class="h-100 p-2 shadow-lg">
                                    <span class="p-md-2 d-block bg-secondary text-light">Lý lịch sửa chữa</span><br>

                                    <span class="p-md-2 d-block bg-primary text-light">Thêm sửa chữa</span>
                                    <div class="pt-2 ">
                                        <textarea name="repair_history" id="" class="w-100">

                                        </textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center ">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Lưu thông tin
                    </button>
                </div>

            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection
