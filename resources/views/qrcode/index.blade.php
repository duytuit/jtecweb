@extends('frontend.layouts.master')

@section('title')
    {{ config('app.name') }} | {{ config('app.description') }}
@endsection

@section('main-content')
    <main class="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 mt-5">

                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h4>Tạo mã QR code</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ url('qrcode') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                    <input type="file" name="import_file" class="form-control" />
                                    <button type="submit" class="btn btn-primary">Nhập dữ liệu</button>
                                </div>
                            </form>

                                <hr>
                            <form action="{{ url('qrcode/generate') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                    <input type="text" id="inputcode" name="InputCode" class="form-control" />
                                    <button type="submit" class="btn btn-primary">Tạo mã QR</button>
                                </div>
                            </form>
                            <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Mã</th>
                                            <th>QR code</th>
                                        </tr>
                                    </thead>
                                    @if (@$inputCode)
                                        <tbody>
                                            <tr>
                                                <td>{{ $inputCode }}</td>
                                                <td style="text-align: center;">
                                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(50)->margin(1)->generate($inputCode)) !!} ">
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endif

                                    @if (@$collection)
                                    <tbody>
                                        @foreach ($collection[0] as $item)
                                            @if ($item[0])
                                                <tr>
                                                    <td>{{ $item[0] }}</td>
                                                    <td style="text-align: center;">
                                                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(50)->margin(1)->generate((string) $item[0])) !!} ">
                                                    </td>
                                                    
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                    @endif
                                </table>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
{{-- <script>
    function UpdateQRCode() {
        // var inputValue = document.getElementById('inputcode').value;
        var inputValue = document.getElementById('inputcode').value.toString();
        var qrcodeImg = document.getElementById("qrcodeImg");
        document.getElementById('getQrcode').innerText  = inputValue;
        // qrcodeImg.src = "data:image/png;base64, " + "{!! base64_encode(QrCode::format('png')->size(50)->margin(1)->generate(" + inputValue + ")) !!}";
        console.log(inputValue);
    }
</script> --}}

@endsection