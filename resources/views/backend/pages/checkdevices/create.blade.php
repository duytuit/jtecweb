@extends('backend.layouts.master')

@section('title')
    @include('backend.pages.checkdevices.partials.title')
@endsection

@section('admin-content')
    @include('backend.pages.checkdevices.partials.header-breadcrumbs')
    <div class="container-fluid">
        @include('backend.layouts.partials.messages')
        <div class="create-page">
            <?php
            $localIP = getHostByName(getHostName());
            $wifiSSID = '';
            ?>
            <div class="form-body">
                <div class="card-body">
                    <span>Tên máy:</span>
                    <span>{{ $getComputerName }}</span>
                </div>
                <div class="card-body">
                    <span>Thông tin chip:</span>
                    <span>{{ $getProcessorInfo }}</span>
                </div>
                <div class="card-body">
                    <span>Hệ điều hành:</span>
                    <span>{{ $getOSInfo }}</span>
                </div>
                <div class="card-body">
                    <span>Thông tin bộ nhớ RAM:</span>
                    <span>{{ $getTotal }}</span>
                </div>
                <div class="card-body">
                    <span>Thông tin ổ cứng:</span>
                    @foreach ($diskInfo as $disk)
                        <p>{{ $disk['caption'] }} - Dung lượng trống: {{ $disk['size'] }} GB, Tổng dung lượng:
                            {{ $disk['freeSpace'] }} GB
                        </p>
                    @endforeach
                </div>
                <div class="card-body">
                    <span>Người thao tác:</span>
                    <input type="text" name="devicesName" id="devicesName" value="" placeholder="Người thao tác">
                </div>
                <div class="card-body">
                    <span>Thời gian hiện tại:</span>
                    <span>{{ date('Y-m-d H:i:s', time()) }}</span>
                </div>
                <div class="card-body">
                    <span>Kết nối wifi:</span>
                    <span>{{ $getWifiSSID ? $getWifiSSID : '' }}</span>
                </div>
                <div class="card-body">
                    <span>Địa chỉ IP:</span>
                    <span>{{ $localIP }}</span>
                </div>
                <div class="card-body">
                    <span>Định vị hiện tại:</span>
                    <input type="text" name="devicesName" id="devicesName" value="" placeholder="Định vị hiện tại">
                </div>
                <div class="card-body">
                    <button class="btn btn-success " onclick="initialize()">Hiện vị trí</button>
                    <div id="location-map" style="display:none;"></div>
                </div>
            </div>
            <div class="row fixed-bottom">
                <div class="col-md-6 form-actions mx-auto">
                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                        Save</button>
                    <a href="{{ route('admin.requireds.index') }}" class="btn btn-dark">Cancel</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=vi"></script>
    <script>
        var myMap;
        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();
        var marker;
        var addr_comps = new Array();

        function initialize() {
            $('#location-map').hide();

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    mapServiceProvider(position.coords.latitude, position.coords.longitude);
                    console.log(position.coords.latitude);
                    console.log(position.coords.longitude);
                    $('#location-map').show();

                }, errorHandler);
            } else {
                console.log('瀏覽器不支援 HTML5 定位');
                // notify('瀏覽器不支援 HTML5 定位, 請手動設定地址！', 'error');
            }
        } //end initialize

        function errorHandler(error) {
            switch (error.code) {
                case error.TIMEOUT:
                    console.log('連線逾時');
                    // notify('連線逾時, 請重試！', 'error');
                    break;
                case error.POSITION_UNAVAILABLE:
                    console.log('無法取得定位！');
                    // notify('無法取得定位！', 'error');
                    break;
                case error.PERMISSION_DENIED: //拒絕
                    console.log('請開啓手機的GPS定位功能！');
                    // notify('請開啓手機的GPS定位功能！', 'error');
                    break;
                case error.UNKNOWN_ERROR:
                    console.log('不明的錯誤，請稍候再試');
                    // notify('不明的錯誤，請稍候再試！', 'error');
                    break;
            }
        } //end errorHandler

        //reverse geocoding
        function codeLatLng(latlng) {
            // reportLocation.reset();
            geocoder.geocode({
                'latLng': latlng
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        addr_comps = results[0].address_components;
                        var content = "<div id='content' class='report-address-info-window'>" + results[0]
                            .formatted_address + "</div>"
                        infowindow.setContent(content);
                        infowindow.open(myMap, marker);
                        $('input#location').val(results[0].formatted_address);
                    } else {
                        console.log("codeLatLng fail, no result found");
                        notify("無法取得地址, 請手動設定地址！", "error");
                    }
                } else {
                    console.log("codeLatLng failed due to: " + status);
                    notify("無法取得地址, 請手動設定地址！", "error");
                }
            });
        } //end codeLatLng

        function mapServiceProvider(lat, lng) {
            var latlng = new google.maps.LatLng(lat, lng);

            var mapOptions = {
                zoom: 12,
                center: latlng,
                mapTypeControl: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            myMap = new google.maps.Map(document.getElementById("location-map"), mapOptions);
            marker = new google.maps.Marker({
                position: latlng,
                map: myMap,
                draggable: true,
            });

            myMap.setZoom(18);
            myMap.setCenter(marker.getPosition());
            codeLatLng(latlng);

            google.maps.event.addListener(marker, 'dragend', function() {
                var point = marker.getPosition();
                myMap.panTo(point);
                codeLatLng(point);
            });
        } //end mapServiceProvider
    </script>
@endsection
<style type="text/css">
    html {
        height: 100%
    }

    body {
        height: 100%;
        margin: 0;
        padding: 0
    }

    #location-map {
        height: 300px;
    }
</style>
