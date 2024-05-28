@extends('backend.layouts.master')

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
        @include('backend.layouts.partials.messages')
        <form action="{{ route('admin.checkdevices.store') }}" method="POST" enctype="multipart/form-data"
            data-parsley-validate data-parsley-focus="first">
            @csrf
            <input type="hidden" id="requiredType" name="requiredType" value="3">
            <div class="row">
                <div class="col-md-4">
                    <div class="create-page">
                        <?php
                        $localIP = getHostByName(getHostName());
                        $wifiSSID = '';
                        ?>
                        <div class="form-body">
                            <div class="p-2">
                                <span>Người thao tác:</span>
                                <span>SuperAdmin</span>
                            </div>
                            <div class="p-2">
                                <span>Vị trí hiện tại:</span>
                                <input class="border-0 outline-none ml-2" id="devices_position" name="devices_position"
                                    type="text" value="{{ isset($positionsByName[0]) ? $positionsByName[0] : '' }}">
                            </div>
                            <div class="p-2">
                                <span>Tên máy:</span>
                                <input class="border-0 outline-none ml-2" id="devices_name" name="devices_name"
                                    type="text" value="{{ $getComputerName }}">
                                {{-- <span>{{ $getComputerName }}</span><br> --}}
                                {{-- <span id="device_info">Loading...</span> --}}
                            </div>

                            <div class="p-2">
                                <span>Thời gian hiện tại:</span>
                                <span>{{ date('Y-m-d H:i:s', time()) }}</span>
                            </div>
                            <div class="p-2">
                                <span>Địa chỉ IP:</span>
                                <input class="border-0 outline-none ml-2" id="devices_ip" name="devices_ip" type="text"
                                    value="{{ $localIP }}">
                                {{-- <span>{{ $localIP }}</span> --}}
                                {{-- <pre id="output"></pre> --}}
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 form-actions mx-auto">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                        Yêu cầu vị trí mới</button>
                                    <a href="{{ route('admin.requireds.index') }}" class="btn btn-dark">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <table class="checkdevices-table">
                        <tbody>
                            <tr class="row">
                                @php $count = 0; @endphp
                                @foreach ($requiredNews as $requiredNew)
                                    <td class="tg-0pky" style="width: calc(100% / 8)">
                                        <span>{{ $requiredNew['position'] }}</span><br>
                                        <label for="{{ $requiredNew['position'] }}">
                                            <img style="object-fit: contain;object-position: top center;"
                                                src="{{ '../../public/assets/images/pages/tablet.png' }}" alt="">
                                        </label>
                                        <input name="devicesInput" id="{{ $requiredNew['position'] }}"
                                            style="width:14px;height:14px; vertical-align: middle;" type="radio"
                                            value="{{ $requiredNew['position'] }}"
                                            @if (in_array($requiredNew['position'], $positions)) disabled @endif
                                            @if ($positionsByName[0] && $requiredNew['position'] == $positionsByName[0]) checked @endif> <br>
                                        <span
                                            class="{{ $positionsByName[0] && $requiredNew['position'] == $positionsByName[0] ? 'text-danger' : '' }}">{{ @$requiredNew['name'] }}
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
            </div>
            <div class="card-body">
                <button class="btn btn-success " onclick="initialize()">Hiện vị trí</button>
                <div id="location-map" style="display:none;"></div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('input[name="devicesInput"]').change(function() {
                $('#devices_position').val(this.value);
            });
        });
    </script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=vi"></script>
    <script>
        var myMap;
        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();
        var marker;
        var addr_comps = new Array();

        function initialize(e) {
            // $('#location-map').hide();
            e.preventDefault();
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    mapServiceProvider(position.coords.latitude, position.coords.longitude);
                    console.log(position.coords.latitude);
                    console.log(position.coords.longitude);
                    // $('#location-map').show();

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
    <script>
        if (navigator.userAgentData) {
            navigator.userAgentData
                .getHighEntropyValues([
                    "model",
                    "platform"
                ])
                .then((ua) => {
                    const model = ua["model"];
                    const platform = ua["platform"];

                    let deviceInfo = ``;
                    if (model) deviceInfo += `Model: ${model}, `;
                    if (platform) deviceInfo += `Platform: ${platform}, `;
                    document.getElementById('device_info').innerText = deviceInfo;
                });
        } else {
            document.getElementById('device_info').innerText = 'navigator.userAgentData is not supported in this browser.';
        }
    </script>
    <script>
        const RTCPeerConnection = window.RTCPeerConnection || window.webkitRTCPeerConnection || window.mozRTCPeerConnection;
        // Function to get local IP
        function getLocalIP() {
            return new Promise((resolve, reject) => {
                const pc = new RTCPeerConnection({
                    iceServers: []
                });
                const localIPs = {};
                pc.createDataChannel('');
                pc.createOffer().then((sdp) => {
                    pc.setLocalDescription(sdp);
                });
                pc.onicecandidate = (ice) => {
                    if (!ice || !ice.candidate || !ice.candidate.candidate) return;
                    const ip = /([0-9]{1,3}(\.[0-9]{1,3}){3})/.exec(ice.candidate.candidate)[1];
                    if (!localIPs[ip]) {
                        localIPs[ip] = true;
                        resolve(ip);
                    }
                };
            });
        }

        getLocalIP().then((ip) => {
            document.getElementById('output').textContent = 'Local IP: ' + ip;
        }).catch((error) => {
            document.getElementById('output').textContent = 'Error: ' + error;
        });
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
