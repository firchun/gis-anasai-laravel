<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME' ?? 'Sinai') }} {{ $title ?? '' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('frontend') }}/img/icon/bavel.png">

    <!-- Meta Description -->
    <meta name="description" content="Anasai Travel Time">
    <meta name="keywords" content="Travel, Anasai, Tourism">
    <meta name="robots" content="index, nofollow">
    <meta name="web_author" content="mix-dev">
    <meta name="language" content="Indonesian">
    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Import Icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/ionicons.min.css">

    <!-- Import Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/main.css">

    <style>
        .rate {
            float: left;
            height: 50px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rated:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }

        .star-rating-complete {
            color: #c59b08;
        }

        .rating-container .form-control:hover,
        .rating-container .form-control:focus {
            background: #fff;
            border: 1px solid #ced4da;
        }

        .rating-container textarea:focus,
        .rating-container input:focus {
            color: #000;
        }

        .rated {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rated:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rated:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ffc700;
        }

        .rated:not(:checked)>label:before {
            content: '★ ';
        }

        .rated>input:checked~label {
            color: #ffc700;
        }

        .rated:not(:checked)>label:hover,
        .rated:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rated>input:checked+label:hover,
        .rated>input:checked+label:hover~label,
        .rated>input:checked~label:hover,
        .rated>input:checked~label:hover~label,
        .rated>label:hover~input:checked~label {
            color: #c59b08;
        }

        .icon {
            font-size: 24px;
            margin-right: 10px;
        }
    </style>
    {{-- add css  --}}
    @stack('style')
    <style>
        .underline-half {
            position: relative;
            display: inline-block;
        }

        .underline-half::after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 120%;
            /* Atur lebar garis bawah di sini, 50% dari panjang keseluruhan */
            height: 3px;
            /* Atur ketebalan garis bawah di sini */
            background-color: #F9690E;
            /* Atur warna garis bawah di sini */
        }

        .underline-center {
            position: relative;
            display: inline-block;
            text-align: center;
            /* Pusatkan teks */
        }

        .underline-center::after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            /* Pusatkan garis bawah */
            width: 50%;
            /* Sesuaikan lebar sesuai keinginan Anda */
            height: 5px;
            background-color: #F9690E;
        }

        .zoom-hover {
            overflow: hidden;
            position: relative;
        }

        .zoom-hover img {
            transition: transform 0.3s;
            /* Transisi efek zoom */
        }

        .zoom-hover:hover img {
            transform: scale(1.1);
            /* Efek zoom saat dihover */
        }

        .gradient-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 80%;
            /* Tinggi gradient */
            background: linear-gradient(to top, rgba(0, 0, 0, 0.582), rgba(0, 0, 0, 0));
            pointer-events: none;
        }

        .floating-button {
            justify-content: center;
            display: flex;
            align-items: center;
            /* line-height: 46PX; */
            text-align: center;
            height: 60px;
            width: 60px;
            position: fixed;
            bottom: 50px;
            right: 50px;
            background-color: #f25601;
            border-radius: 50%;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
        }

        .floating-button a {

            color: #ffffff;
            text-decoration: none;
            text-align: center;
            /* color: #F9690E; */
        }

        .badge-top-right {
            position: absolute;
            top: 0;
            right: 0;
        }

        /* chat */
        .chat_box {
            background: #fff;
            width: 400px;

            height: 435px;
            position: fixed;
            bottom: 0px;
            right: 14px;
            border: none;
            border-radius: 5px 5px 0 0;
            -webkit-box-shadow: 0 10px 50px 0 rgba(0, 0, 0, 0.25);
            -moz-box-shadow: 0 10px 50px 0 rgba(0, 0, 0, 0.25);
            box-shadow: 0 10px 50px 0 rgba(0, 0, 0, 0.25);
            overflow: hidden;
            z-index: 1000000;
            display: none
        }

        /* Media query for mobile devices */
        @media (max-width: 767px) {
            .chat_box {
                width: 100%;
                right: 0;
                left: 0;
                border-radius: 0;
            }
        }

        .pesan_chat {
            text-align: center;
            text-decoration: none;
            display: block;
            height: 100%;
            padding: 5px 5px 15px
        }

        .chatheader {
            margin: 0 auto;
            padding: 0 10px;
            height: 35px;
            line-height: 35px;
            font-size: 16px;
            font-weight: 700;
            color: #fff;
            text-align: left;
            display: block;
            cursor: pointer;
            background: #f25601;
        }

        .pesan_chat p {
            color: #616161;
            font-size: 14px;
            margin: 10px
        }

        .close-chatfb {
            position: absolute;
            top: 0;
            right: 0;
            font-family: Arial;
            font-size: 24px;
            font-weight: 700;
            cursor: pointer;
            width: 24px;
            color: #fff;
            height: 35px;
            line-height: 35px;
            text-align: center;
            opacity: .7
        }

        .close-chatfb:hover,
        .maxi-chatfb:hover,
        .mini-chatfb:hover {
            opacity: 1
        }

        .round.hollow {
            margin: 40px 0 0;
        }

        .round.hollow a {
            border: 2px solid #2c4584;
            border-radius: 35px;
            color: #2c4584;
            font-size: 23px;
            padding: 10px 21px;
            text-decoration: none;
            font-family: 'Open Sans', sans-serif;
        }

        .round.hollow a:hover {
            border: 2px solid #138be6;
            border-radius: 35px;
            color: red;
            color: #000;
            font-size: 23px;
            padding: 10px 21px;
            text-decoration: none;
        }

        .popup-box-on {
            display: block !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body style="background: white;">
    @include('layouts.front_component.navbar')
    @include('layouts.front_component.sidebar')
    <section class="sidebar-overlay"></section>
    @yield('content')
    @include('layouts.front_component.footer')
    @guest
        <div class="floating-button ">
            <a href="{{ route('login') }}"><i class="ion-chatbubble" style="font-size: 50px;"></i>
            </a>
        </div>
    @else
        @if (Auth::user()->role == 'member')
            @php
                $chatRooms = DB::table('chat_room_users')
                    ->where('id_user', Auth::user()->id)
                    ->get();

                $check_not_read = 0;
                $roomUserIds = [];
                foreach ($chatRooms as $chatRoom) {
                    $roomUserIds[] = DB::table('chat_room_users')
                        ->where('id_user', '!=', Auth::user()->id)
                        ->where('chat_room_id', $chatRoom->chat_room_id)
                        ->get();
                    $unreadCount = App\Models\Chat::where('id_user', '!=', Auth::user()->id)
                        ->where('chat_room_id', $chatRoom->chat_room_id)
                        ->where('is_read', 0) // Assuming you have an 'is_read' column to mark read or unread messages
                        ->count();

                    $check_not_read += $unreadCount;
                }
            @endphp
            <div class="floating-button ">
                @if ($check_not_read != 0)
                    <span class="badge badge-warning badge-top-right text-light " style="font-size: 18px;">
                        {{ $check_not_read }} </span>
                @endif
                <a href="#" id="addClass" onclick="return false;">
                    <i class="ion-chatbubble" style="font-size: 50px;"></i>
                </a>
            </div>

            {{-- content chat --}}
            <div class="chat_box" id="qnimate">
                <div class="chatheader">
                    Chat!
                </div>
                <div class='close-chatfb' id="removeClass">
                    &#215;</div>
                <div class="pesan_chat">

                    @foreach ($roomUserIds as $roomUserId)
                        @php
                            $lapak = App\Models\Lapak::where('id_user', $roomUserId[0]->id_user)->first();
                            $chat = App\Models\Chat::where('chat_room_id', $roomUserId[0]->chat_room_id)
                                ->where('id_user', '!=', Auth::user()->id)
                                ->latest()
                                ->first();
                            $time_chat = App\Models\Chat::where('chat_room_id', $roomUserId[0]->chat_room_id)
                                ->latest()
                                ->first();
                            $chat_total = App\Models\Chat::where('chat_room_id', $roomUserId[0]->chat_room_id)
                                ->where('id_user', '!=', Auth::user()->id)
                                ->where('is_read', 0)
                                ->count();
                            // echo $roomUserId;
                        @endphp
                        <a href="{{ route('chat', $lapak->id_user) }}" style="text-decoration: none;">
                            <div class="card p-2 m-2 border border-warning text-left shadow shadow-sm">
                                <div class="row align-items-center">
                                    <div class="col-1">
                                        <i class="fa fa-store pr-3"></i>
                                    </div>
                                    <div class="col">
                                        <strong>{{ $lapak->nama_lapak }}
                                            @if ($chat_total > 0)
                                                <span class="badge badge-warning">{{ $chat_total }}</span>
                                            @endif
                                        </strong>
                                        <br>
                                        <span class="text-dark mb-0 px-2 py-1 rounded"
                                            style="background-color: rgb(231, 230, 230);">
                                            {{ Str::limit($chat->message, 20) }}</span>
                                        <br>
                                        <small class="text-muted"
                                            style="font-size: 10px;">{{ $time_chat->created_at->diffFOrHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @endguest
    <script type="text/javascript" src="{{ asset('frontend') }}/js/jquery.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/main.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/swipe.js"></script>
    {{-- < !-- JS, Popper.js, and jQuery --> --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-pzjw8f+1GLh1jtm4XV6zFGrJEk5U0/ks6OMvXJ4/8IZ5C+daDH+H8jDDFtQF0ZLTV" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-r2QWa2sNPJ4g3+R3sLlU9GOzGJhjG7e12St3OM4BPDMLwv6NBRImO0i4bXKEF2+0" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-M1gr6FqKtp2l2w2MaC5lGv6tJ5Xs2qTTrJnT5Vd5M8F5lHM5nXwN/1wZlKaXjk6R" crossorigin="anonymous">
    </script>{{-- add script --}} @stack('script')
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
    <script>
        $(function() {
            $("#addClass").click(function() {
                $('#qnimate').addClass('popup-box-on');
            });

            $("#removeClass").click(function() {
                $('#qnimate').removeClass('popup-box-on');
            });
        })
        $(function() {
            $("#qnimate").draggable({
                containment: "window"
            });
        });
        //<![CDATA[
        function init() {
            var vidDefer = document.getElementsByTagName('iframe');
            for (var i = 0; i < vidDefer.length; i++) {
                if (vidDefer[i].getAttribute('data-src')) {
                    vidDefer[i].setAttribute('src', vidDefer[i].getAttribute('data-src'));
                }
            }
        }
        window.onload = init;
        //]]>
    </script>
</body>

</html>
