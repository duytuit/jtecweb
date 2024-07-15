@extends('frontend.layouts.master')

@section('title')
    {{ config('app.name') }} | {{ config('app.description') }}
@endsection

@section('main-content')
    <main class="main">
        <!-- Page Content -->
        <input type="hidden" id="joinRoom" value="checkdevices">
        <input type="hidden" id="username" value="{{$uuid}}">
        <input type="hidden" id="ip_client" value="{{$ip_client}}">
        <input type="hidden" id="device" value="{{$device}}">
        <input type="hidden" id="current_time">
        <div class="container text-center">
            <h3>THEO DÕI THIẾT BỊ IPAD</h3>
            <div class="display-date">
                <span id="day">Ngày</span>,
                <span id="daynum">00</span>
                <span id="month">Tháng</span>
                <span id="year">0000</span>
            </div>
            <div class="display-time" style="display: inline;"></div>
            <div>IP: <strong>{{$ip_client}}</strong></div>
            <div>Device: <strong>{{$device}}</strong></div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
         var socket;
         var socketId='';
         var room = document.getElementById('joinRoom').value;
         var username = document.getElementById('username').value;
         var ip_client = document.getElementById('ip_client').value;
         var device = document.getElementById('device').value;
         const displayTime = document.querySelector(".display-time");
         var _time = new Date();
         $('#current_time').val( _time.toLocaleTimeString()+ ' '+ _time.getDate()+'-'+(_time.getMonth()+1)+'-'+_time.getFullYear());
         var current_time = _time.toLocaleTimeString()+ ' '+ _time.getDate()+'-'+(_time.getMonth()+1)+'-'+_time.getFullYear();
         var count=0;
         var background='#09e3ef';
        function check_device(status){
            $.ajax({
                        url: "{{ route('check_device_store') }}",
                        method: 'POST',
                        data: {
                            room:room,
                            username:username,
                            ip_client:ip_client,
                            device:device,
                            current_time:current_time,
                            status:status
                        },
                        success: function(data) {
                            console.log(data);
                        }
                    });
        }
        check_device('in');
        socket = io("http://127.0.0.1:8091", {
            cors: {
                origin: "http://192.168.207.6:8088",
                methods: ["GET", "POST"]
            },
            transports : ['websocket']
        });

        socket.on('connect', function() {
           console.log('connected');
           socketId += socket.id;
           console.log(socketId);

        });

        socket.emit('joinRoom', { room, username });

        socket.on('warning', function(data) {
          if(data.status == false){
            socket.emit('createRoom', { room });
          }
        });

        window.addEventListener('beforeunload', function (event) {
            let time = new Date();
            current_time = time.toLocaleTimeString()+ ' '+ time.getDate()+'-'+(time.getMonth()+1)+'-'+time.getFullYear();
            socket.emit('chat', {room:'checkdevices', sender: username, message: JSON.stringify({
                room:room,
                username:username,
                ip_client:ip_client,
                device:device,
                current_time:current_time,
                status:'out'
            }) });
        });

        // Time
        function showTime() {
            let time = new Date();
            displayTime.innerText = time.toLocaleTimeString();
            setTimeout(()=>{
                showTime();
                count+=1;
                if(count === 2){
                    socket.emit('chat', {room:'checkdevices', sender: username, message: JSON.stringify({
                        room:room,
                        username:username,
                        ip_client:ip_client,
                        device:device,
                        current_time:current_time,
                        status:'in'
                    }) });
                    count=0
                    if(background == '#09e3ef'){
                        background='transparent';
                        displayTime.style.cssText = 'display: inline;padding:3px;background:'+background;
                    }else{
                        background='#09e3ef';
                        displayTime.style.cssText = 'display: inline;padding:3px;background:'+background;
                    }
                }
            }, 1000);
        }
        showTime();
        // Date
        function updateDate() {
            let today = new Date();

            // return number
            let dayName = today.getDay(),
                dayNum = today.getDate(),
                month = today.getMonth(),
                year = today.getFullYear();

            const months = [
                "Tháng 1",
                "Tháng 2",
                "Tháng 3",
                "Tháng 4",
                "Tháng 5",
                "Tháng 6",
                "Tháng 7",
                "Tháng 8",
                "Tháng 9",
                "Tháng 10",
                "Tháng 11",
                "Tháng 12",
            ];
            const dayWeek = [
                "Chủ Nhật",
                "Thứ 2",
                "Thứ 3",
                "Thứ 4",
                "Thứ 5",
                "Thứ 6",
                "Thứ 7",
            ];
            // value -> ID of the html element
            const IDCollection = ["day", "daynum", "month", "year"];
            // return value array with number as a index
            const val = [dayWeek[dayName], dayNum, months[month], year];
            for (let i = 0; i < IDCollection.length; i++) {
                document.getElementById(IDCollection[i]).firstChild.nodeValue = val[i];
            }
        }
        updateDate();
    </script>
@endsection
