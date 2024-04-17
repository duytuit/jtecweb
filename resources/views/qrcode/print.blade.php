@extends('frontend.layouts.master')

@section('title')
    {{ config('app.name') }} | {{ config('app.description') }}
@endsection

@section('main-content')
    <main class="main">
        <div class="print-btn text-center">
            <a href="javascript:window.print()" class="btn btn-success">In dữ liệu A4</a>
            {{-- <a href="javascript:window.print()" class="btn btn-success">In thẻ</a> --}}
            <a href="/qrcode" class="btn btn-primary">Quay lại tạo Qrcode</a>
        </div>
        <div class="print-container">
            <div class="print-wrapper">
                @if (@$printcollection)
                    @php
                        $counter = 0;
                    @endphp

                    @foreach ($printcollection[0] as $item)
                        @if ($item[0])
                            @if ($counter % 25 == 0)
                                <div class="wrapper-25 d-flex ">
                            @endif

                            <div class="card">
                                <div class="card-body">
                                    <div class="card-code">
                                        <strong>{{ $item[0] }}</strong>
                                    </div>
                                    <div class="card-qrcode">
                                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->margin(1)->generate((string) $item[0])) !!} ">
                                    </div>
                                    <div class="card-position">
                                        <strong>CẮT</strong>
                                    </div>
                                </div>
                            </div>

                            @if ($counter % 25 == 24 || $loop->last)
            </div>
            @endif

            @php
                $counter++;
            @endphp
            @endif
            @endforeach
            @endif
        </div>

        </div>
    </main>
@endsection
