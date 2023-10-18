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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQvI0cmNUe4m6H2qXrJ/zA5Df3JOWa9b9QPrzFNm9lBLvt2Wr9lKyp" crossorigin="anonymous">

    <!-- Import Icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/ionicons.min.css">

    <!-- Import Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/main.css">

    {{-- add css  --}}
    @stack('style')

</head>

<body>
    @include('layouts.front_component.navbar')
    @include('layouts.front_component.sidebar')
    <section class="sidebar-overlay"></section>@yield('content') @include('layouts.front_component.footer')
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
