<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bavel - Bali Travel Time</title>
    <link rel="icon" type="image/png" href="{{ asset('frontend') }}/img/icon/bavel.png">

    <!-- Meta Description -->
    <meta name="description" content="Anasai Travel Time">
    <meta name="keywords" content="Travel, Anasai, Tourism">
    <meta name="robots" content="index, nofollow">
    <meta name="web_author" content="mix-dev">
    <meta name="language" content="Indonesian">

    <!-- Import Icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/ionicons.min.css">

    <!-- Import Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/main.css">

</head>

<body>

    @include('layouts.front_component.navbar')
    @include('layouts.front_component.sidebar')



    <!-- Sidebar Overlay -->
    <section class="sidebar-overlay"></section>

    @yield('content')

    @include('layouts.front_component.footer')


    <script type="text/javascript" src="{{ asset('frontend') }}/js/jquery.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/main.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/swipe.js"></script>
</body>

</html>
