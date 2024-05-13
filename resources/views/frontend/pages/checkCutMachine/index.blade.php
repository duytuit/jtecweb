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
                            <h4>BẢNG KIỂM TRA HÀNG NGÀY MÁY CẮT</h4>
                        </div>
                        <div class="card-body">
                            <form class="cat-style" action="{{ }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">

                                </div>
                            </form>
                            <hr>
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
