@extends('layouts.app')
@push('style')
    <style>
        #gmap {
            height: 100%;
        }

        .popupContent {
            width: 400px;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
@endpush
@section('content')
    @include('pages.landing_page.component.login')

    @include('pages.landing_page.component.header')

    @include('pages.landing_page.component.maps')

    @include('pages.landing_page.component.feature')

    @include('pages.landing_page.component.desa')

    <div class="container my-3 text-center "
        style="background-image: url('{{ asset('frontend/img/header4.jpg') }}'); background-size: cover;  border-radius:20px; padding-top:50px; padding-bottom:50px;">
        <div class="offset-lg-3 col-lg-9 col-sm-12 subscribe-form">
            <div class="container subscribe-form-content">
                <h4 class="text-left text-white">Anda dapat mencari tempat wisata dan event di sini.</h4>
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-lg-9 col-sm-12 form-element">
                            <input placeholder="Cari di sini.." type="email" class="form-control" name="keywords"
                                autocomplete="off">
                        </div>
                        <div class="col-lg-3 col-sm-12 form-element">
                            <button class="btn btn-block btn-primary py-2" type="submit">
                                Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('pages.landing_page.component.wisata')
    @include('pages.landing_page.component.kegiatan')


    <section class="section-explore" style="height: 300px;">
        <div class="texture-handler-top"></div>
        <div class="overlay" style=" background: rgba(0, 0, 0, 0.6);">
            <div class="container">

                <div class="caption text-left">
                    <h1 style="font-size: 60px; font-family:'Lobster';">Merchandise of Sinai</h1>
                    <p>Temukan marchandise khas dari kawasan sinai di sini...</p>
                </div>
            </div>
        </div>
        <div class="texture-handler-bottom"></div>
    </section>

    @include('pages.landing_page.component.lapak')


    {{-- <!-- Section Newsletter -->

    <section class="section-testi">
        <div class="overlay">
            <div class="head">
                <h3>Tourist Says</h3>
            </div>
            <div id='mySwipe' class='swipe'>
                <div class="swipe-wrap">
                    <div class="blockquote">
                        <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. </p>
                        <div class="blockquote-user">
                            <div class="blockquote-avatar">
                                <img src="{{ asset('frontend') }}/img/faces/clem-onojeghuo-2.jpg" alt="Bae Hyo-Rin">
                            </div>
                            <div class="blockquote-name">John Doe</div>
                        </div>
                    </div>
                    <div class="blockquote">
                        <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. </p>
                        <div class="blockquote-user">
                            <div class="blockquote-avatar">
                                <img src="{{ asset('frontend') }}/img/faces/joe-gardner-2.jpg" alt="Bae Hyo-Rin">
                            </div>
                            <div class="blockquote-name">Jane Doe</div>
                        </div>
                    </div>
                    <div class="blockquote">
                        <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. </p>
                        <div class="blockquote-user">
                            <div class="blockquote-avatar">
                                <img src="{{ asset('frontend') }}/img/faces/clem-onojeghuo-3.jpg" alt="Bae Hyo-Rin">
                            </div>
                            <div class="blockquote-name">John Roe</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overlay-btn">
                <button class="btn-orange btn-bullet" onclick='mySwipe.prev()'><span
                        class="ion-arrow-left-c"></span></button> &nbsp;
                <button class="btn-orange btn-bullet" onclick='mySwipe.next()'><span
                        class="ion-arrow-right-c"></span></button>
            </div>
        </div>
    </section> --}}
@endsection
