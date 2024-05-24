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
        font-size: 14px;
        overflow: hidden;
        padding: 10px 5px;
        word-break: normal;
    }

    .checkdevices-table th {
        border-style: solid;
        border-width: 0px;
        font-family: Arial, sans-serif;
        font-size: 14px;
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
        text-align: left;
        vertical-align: top
    }
</style>
@section('admin-content')
    @include('backend.pages.checkdevices.partials.header-breadcrumbs')
    <div class="container-fluid">
        @include('backend.layouts.partials.messages')
        <div class="row">
            <div class="col-md-4">
                <div class="create-page">
                    <?php
                    $localIP = getHostByName(getHostName());
                    $wifiSSID = '';
                    ?>
                    <div class="form-body">
                        <div class="card-body">
                            <span>Tên máy:</span>
                            <span>{{ $getComputerName }}</span>
                            <p id="device_info">Loading...</p>
                        </div>
                        <div class="card-body">
                            <span>Người thao tác:</span>
                            <input type="text" name="devicesName" id="devicesName" value=""
                                placeholder="Người thao tác">
                        </div>
                        <div class="card-body">
                            <span>Thời gian hiện tại:</span>
                            <span>{{ date('Y-m-d H:i:s', time()) }}</span>
                        </div>
                        <div class="card-body">
                            <span>Địa chỉ IP:</span>
                            <span>{{ $localIP }}</span>
                            <pre id="output"></pre>
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
            <div class="col-md-8">
                <table class="checkdevices-table">
                    <thead>
                        <tr>
                            <th class="tg-0lax"></th>
                            <th class="tg-0lax">1</th>
                            <th class="tg-0lax">2</th>
                            <th class="tg-0lax">3</th>
                            <th class="tg-0lax">4</th>
                            {{-- <th class="tg-0lax">5</th> --}}
                            <th class="tg-0lax"></th>
                            <th class="tg-0lax">1</th>
                            <th class="tg-0lax">2</th>
                            <th class="tg-0lax">3</th>
                            <th class="tg-0lax">4</th>
                            {{-- <th class="tg-0lax">5</th> --}}
                            <th class="tg-0lax"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tg-73oq tg-73oq-text text-right">Giá 1 - Trái</td>
                            <td class="tg-0pky">
                                <img style="height: 50px; object-fit: contain;object-position: top center;" class="w-100"
                                    src="{{ '../../public/assets/images/pages/tablet.png' }}" alt="">
                                <hr>
                                <img style="height: 50px; object-fit: contain;object-position: top center;" class="w-100"
                                    src="{{ '../../public/assets/images/pages/tablet.png' }}" alt="">
                            </td>
                            <td class="tg-0pky">
                                <img style="height: 50px; object-fit: contain;object-position: top center;" class="w-100"
                                    src="{{ '../../public/assets/images/pages/tablet.png' }}" alt="">
                                <hr>
                                <img style="height: 50px; object-fit: contain;object-position: top center;" class="w-100"
                                    src="{{ '../../public/assets/images/pages/tablet.png' }}" alt="">
                            </td>
                            <td class="tg-0pky">
                                <img style="height: 50px; object-fit: contain;object-position: top center;" class="w-100"
                                    src="{{ '../../public/assets/images/pages/tablet.png' }}" alt="">
                                <hr>
                                <img style="height: 50px; object-fit: contain;object-position: top center;" class="w-100"
                                    src="{{ '../../public/assets/images/pages/tablet.png' }}" alt="">
                            </td>
                            <td class="tg-0pky">
                                <img style="height: 50px; object-fit: contain;object-position: top center;" class="w-100"
                                    src="{{ '../../public/assets/images/pages/tablet.png' }}" alt="">
                                <hr>
                                <img style="height: 50px; object-fit: contain;object-position: top center;" class="w-100"
                                    src="{{ '../../public/assets/images/pages/tablet.png' }}" alt="">
                            </td>

                            <td class="tg-73oq">

                            </td>
                            <td class="tg-0pky">
                                <img style="height: 50px; object-fit: contain;object-position: top center;" class="w-100"
                                    src="{{ '../../public/assets/images/pages/tablet.png' }}" alt="">
                                <hr>
                                <img style="height: 50px; object-fit: contain;object-position: top center;" class="w-100"
                                    src="{{ '../../public/assets/images/pages/tablet.png' }}" alt="">
                            </td>
                            <td class="tg-0pky">
                                <img style="height: 50px; object-fit: contain;object-position: top center;" class="w-100"
                                    src="{{ '../../public/assets/images/pages/tablet.png' }}" alt="">
                                <hr>
                                <img style="height: 50px; object-fit: contain;object-position: top center;" class="w-100"
                                    src="{{ '../../public/assets/images/pages/tablet.png' }}" alt="">
                            </td>
                            <td class="tg-0pky">
                                <img style="height: 50px; object-fit: contain;object-position: top center;" class="w-100"
                                    src="{{ '../../public/assets/images/pages/tablet.png' }}" alt="">
                                <hr>
                                <img style="height: 50px; object-fit: contain;object-position: top center;" class="w-100"
                                    src="{{ '../../public/assets/images/pages/tablet.png' }}" alt="">
                            </td>
                            <td class="tg-0pky">
                                <img style="height: 50px; object-fit: contain;object-position: top center;" class="w-100"
                                    src="{{ '../../public/assets/images/pages/tablet.png' }}" alt="">
                                <hr>
                                <img style="height: 50px; object-fit: contain;object-position: top center;" class="w-100"
                                    src="{{ '../../public/assets/images/pages/tablet.png' }}" alt="">
                            </td>

                            <td class="tg-73oq tg-73oq-text">Giá 1 - Phải</td>
                        </tr>
                        <tr>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                        </tr>
                        <tr>
                            <td class="tg-73oq tg-73oq-text text-right">Giá 2 - Trái</td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-73oq tg-73oq-text">Giá 2 - Phải</td>
                        </tr>
                        <tr>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                        </tr>
                        <tr>
                            <td class="tg-73oq tg-73oq-text text-right">Giá 3 - Trái</td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-73oq tg-73oq-text">Giá 3 - Phải</td>
                        </tr>
                        <tr>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                        </tr>
                        <tr>
                            <td class="tg-73oq tg-73oq-text text-right">Giá 4 - Trái</td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-73oq tg-73oq-text">Giá 4 - Phải</td>
                        </tr>
                        <tr>
                            <td class="tg-73oq tg-73oq-text text-right">Giá 5 - Trái</td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-73oq tg-73oq-text">Giá 5 - Phải</td>
                        </tr>
                        <tr>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                        </tr>
                        <tr>
                            <td class="tg-73oq tg-73oq-text text-right">Giá 6 - Trái</td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky"></td>
                            <td class="tg-73oq tg-73oq-text">Giá 6 - Phải</td>
                        </tr>
                        <tr>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                            <td class="tg-73oq"></td>
                        </tr>
                    </tbody>
                </table>
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
    <script>
        function getDeviceInfo() {
            const deviceInfoElement = document.getElementById('device_info');
            if (navigator.userAgentData) {
                navigator.userAgentData.getHighEntropyValues([
                    "architecture",
                    "model",
                    "platform",
                    "platformVersion",
                    "fullVersionList"
                ]).then(ua => {
                    let deviceInfo = `You are using: `;
                    if (ua.model) deviceInfo += `Model: ${ua.model}, `;
                    if (ua.platform) deviceInfo += `Platform: ${ua.platform}, `;
                    if (ua.platformVersion) deviceInfo += `Platform Version: ${ua.platformVersion}, `;
                    if (ua.architecture) deviceInfo += `Architecture: ${ua.architecture}, `;
                    if (ua.fullVersionList) {
                        deviceInfo +=
                            `Full Version List: ${ua.fullVersionList.map(item => item.brand + " " + item.version).join(", ")}`;
                    }

                    deviceInfoElement.innerText = deviceInfo;
                });
            } else {
                const ua = navigator.userAgent;
                deviceInfoElement.innerText = `Your User Agent: ${ua}`;
            }
        }
        getDeviceInfo();
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
    <script>
        function median_device_info(deviceInfo) {
            console.log(deviceInfo);
        }

        // You may also call the median_device_info function manually, e.g. on a single page web app
        median.run.deviceInfo();

        // Or return the OneSignal Info via a promise (in async function)
        var deviceInfo = await median.deviceInfo();

        median.deviceInfo().then(function(deviceInfo) {
            console.log(deviceInfo);
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
