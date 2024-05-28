@extends('backend.layouts.master')
@php
    use App\Helpers\ArrayHelper;
@endphp
@section('title')
    @include('backend.pages.checkdevices.partials.title')
@endsection
<style type="text/css">
    .checkdevices-table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
    }

    .checkdevices-table td {
        border-style: solid;
        border-width: 1px;
        font-family: Arial, sans-serif;
        font-size: 12px;
        overflow: hidden;
        padding: 10px 5px;
        word-break: normal;
    }

    .checkdevices-table th {
        border-style: solid;
        border-width: 0px;
        font-family: Arial, sans-serif;
        font-size: 12px;
        font-weight: normal;
        overflow: hidden;
        padding: 10px 5px;
        word-break: normal;
        text-align: center;
    }

    .checkdevices-table .tg-0lax {
        vertical-align: top
    }

    .checkdevices-table .tg-73oq {
        border-color: #000000;
        text-align: left;
        vertical-align: top;
        border-width: 0px;
        width: 20px;
    }

    .checkdevices-table .tg-73oq-text {
        width: fit-content;
        vertical-align: middle;
        text-wrap: nowrap;
    }

    .checkdevices-table .tg-0pky {
        border-color: inherit;
        text-align: center;
        vertical-align: top
    }

    .checkdevices-table .tg-0pky img {
        width: 40px;
        text-align: center;
    }
</style>
@section('admin-content')
    @include('backend.pages.checkdevices.partials.header-breadcrumbs')
    <div class="container-fluid">
        @include('backend.pages.checkdevices.partials.top-show')
        @include('backend.layouts.partials.messages')
        <form id="form-search" action="{{ route('admin.checkdevices.index') }}" method="get">
            <div class="row form-group">
                <div class="col-sm-8">
                </div>
                <div class="col-sm-4 text-right">
                    <div class="input-group">
                        <input type="text" name="keyword" value="{{ $keyword }}" placeholder="Nhập Từ Khóa"
                            class="form-control" />
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                            <button type="button" class="btn btn-warning btn-search-advance" data-toggle="show"
                                data-target=".search-advance"><span class="fa fa-filter"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form><!-- END #form-search -->
        <!-- START #form-search-advance -->
        <form id="form-search-advance" action="{{ route('admin.checkdevices.index') }}" method="get" class="hidden">
            <div id="search-advance" class="search-advance">
                <table class="checkdevices-table">
                    <tbody>
                        <tr class="row">
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($lists as $key => $item)
                                @php
                                    $nameColor = '';
                                    if (!empty($keyword) && strpos($item['name'], $keyword) !== false) {
                                        $nameColor = 'text-danger';
                                    }
                                @endphp
                                <td class="tg-0pky" style="width: calc(100% / 8)">
                                    <span>{{ $item['position'] }}</span><br>
                                    <label for="{{ $item['position'] }}">
                                        <img style="object-fit: contain;object-position: top center;"
                                            src="{{ '../../public/assets/images/pages/tablet.png' }}" alt="">
                                    </label>
                                    <input name="devicesInput" id="{{ $item['position'] }}"
                                        style="width:14px;height:14px; vertical-align: middle;" type="radio"
                                        value="{{ $item['position'] }}" @if ($item['name'] != '') disabled @endif>
                                    <br>
                                    <span class="{{ $nameColor }}">{{ @$item['name'] ? $item['name'] : 'Chưa có máy' }}
                                    </span>
                                </td>
                                @php $count++; @endphp
                                @if ($count % 8 == 0)
                        </tr>
                        <tr class="row mt-3">
                            @endif
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection
