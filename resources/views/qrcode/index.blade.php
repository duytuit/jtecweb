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
                            @if (@$collection)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Mã</th>
                                            <th>QR code</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($collection[0] as $item)
                                            @if ($item[0])
                                                <tr>
                                                    <td>{{ $item[0] }}</td>
                                                    <td style="text-align: center;">
                                                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate((string) $item[0])) !!} ">
                                                    </td>
                                                    
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script></script>
@endsection
