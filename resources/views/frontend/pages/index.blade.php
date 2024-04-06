@extends('frontend.layouts.master')

@section('title')
    {{ config('app.name') }} | {{ config('app.description') }}
@endsection

@section('main-content')
    <main class="main">

        <!-- Page Content -->
        <div class="container">
            <div class="cards">
                <div class="cards_item">
                    <a href="{{ route('exam') }}?type=2">
                  <div class="card">
                        <div class="card_content">
                            <h2 class="card_title">Công Đoạn Cắm</h2>
                            <p class="card_text">Kiểm tra năng lực nhận biết màu dây</p>
                            <a href="{{ route('exam') }}?type=2" class="btn card_btn">Bắt đầu làm bài</a>
                          </div>
                  </div>
                </a>
                </div>
                <div class="cards_item">
                  <div class="card">

                    <div class="card_content">
                      <h2 class="card_title">Công đoạn Demo</h2>
                      <p class="card_text">Nội dung kiểm tra</p>
                      <a href="#" class="btn card_btn">Bắt đầu làm bài</a>
                    </div>
                  </div>
                </div>
                <div class="cards_item">
                  <div class="card">
                    <div class="card_content">
                      <h2 class="card_title">Công đoạn Demo</h2>
                      <p class="card_text">Nội dung kiểm tra</p>
                      <a href="#" class="btn card_btn">Bắt đầu làm bài</a>
                    </div>
                  </div>
                </div>
                <div class="cards_item">
                  <div class="card">
                    <div class="card_content">
                      <h2 class="card_title">Công đoạn Demo</h2>
                      <p class="card_text">Nội dung kiểm tra</p>
                      <a href="#" class="btn card_btn">Bắt đầu làm bài</a>
                    </div>
                  </div>
                </div>
                <div class="cards_item">
                  <div class="card">

                    <div class="card_content">
                      <h2 class="card_title">Công đoạn Demo</h2>
                      <p class="card_text">Nội dung kiểm tra</p>
                      <a href="#" class="btn card_btn">Bắt đầu làm bài</a>
                    </div>
                  </div>
                </div>
                <div class="cards_item">
                  <div class="card">
                    {{-- <div class="card_image"><img src="https://picsum.photos/500/300/?image=2"></div> --}}
                    <div class="card_content">
                      <h2 class="card_title">Công đoạn Demo</h2>
                      <p class="card_text">Nội dung kiểm tra</p>
                      <a href="#" class="btn card_btn">Bắt đầu làm bài</a>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </main>
@endsection
