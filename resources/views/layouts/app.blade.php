<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME' ?? 'Anasai') }} {{ $title ?? '' }}</title>
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
    </style>

</head>

<body style="background: white;">
    @include('layouts.front_component.navbar')
    @include('layouts.front_component.sidebar')
    <section class="sidebar-overlay"></section>
    @yield('content')
    @include('layouts.front_component.footer')
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
</body>

</html>
