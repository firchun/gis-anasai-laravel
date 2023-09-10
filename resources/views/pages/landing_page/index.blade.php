@extends('layouts.app')

@section('content')
    @include('pages.landing_page.component.login')

    @include('pages.landing_page.component.header')

    @include('pages.landing_page.component.about')


    <!-- Section Explore -->

    <section class="section-explore">
        <div class="texture-handler-top"></div>
        <div class="overlay">
            <div class="caption">
                <h2>ENJOY BEUTY & friendliness OF</h2> <br>
                <img src="{{ asset('frontend') }}/img/bali-island.png" alt="Bali Island">
            </div>
        </div>
        <div class="texture-handler-bottom"></div>
    </section>

    <!-- Section Discover -->

    <section class="section section-discover" id="discover">
        <div class="section-head">
            <div class="section-line"></div>
            <h3 class="section-title">DISCOVERY BALI</h3>
            <p class="section-subtitle">Adalah sebuah warisan indahnya alam dan budaya yang masih terjaga di Bali yang
                dapat anda jelajahi</p>
        </div>
        <div class="section-discover-body slides">
            <div class="col">
                <a href="destination.html">
                    <img src="{{ asset('frontend') }}/img/selfie.jpg" alt="Destination">
                    <div class="caption">
                        <p>DESTINATION</p>
                        <div class="line"></div>
                        <div class="caption-text">
                            <p>Kunjungi destinasi wisata yang belum pernah anda temui sebelumnya</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="culture.html">
                    <img src="{{ asset('frontend') }}/img/culture.jpg">
                    <div class="caption" alt="Culture">
                        <p>CULTURE</p>
                        <div class="line"></div>
                        <div class="caption-text">
                            <p>Selain pemandangan yang indah bali juga memiliki budaya yang mengesankan</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="event.html">
                    <img src="{{ asset('frontend') }}/img/event.jpg">
                    <div class="caption" alt="Event">
                        <p>EVENT</p>
                        <div class="line"></div>
                        <div class="caption-text">
                            <p>Ikuti dan ketahui event - event menarik yang berlangsung di Bali</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="stay.html">
                    <img src="{{ asset('frontend') }}/img/stay.jpg">
                    <div class="caption" alt="Stay">
                        <p>WHERE TO STAY</p>
                        <div class="line"></div>
                        <div class="caption-text">
                            <p>Temukan tempat penginapan terbaik dengan harga yang relatif murah</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Gallery Bali -->

    <section class="section section-gallery">
        <div class="section-head">
            <div class="section-line"></div>
            <h3 class="section-title">OUR GALLERY</h3>
            <p class="section-subtitle">Potret indahnya kenampakan Bali yang tidak boleh anda lewatkan</p>
        </div>
        <div class="section-gallery-body">
            <div class="row">
                <div class="col-video">
                    <video controls>
                        <source src="{{ asset('frontend') }}/img/explore.mp4" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>
                </div>
                <div class="col-image">
                    <div class="row">
                        <div class="col" onclick="window.location.href='gallery.html'">
                            <img
                                src="{{ asset('frontend') }}/img/Gallery/27573391_1831430933557419_8533318736831053824_n.jpg">
                            <div class="overlay">
                                <span class="ion-search"></span>
                            </div>
                        </div>
                        <div class="col" onclick="window.location.href='gallery.html'">
                            <img
                                src="{{ asset('frontend') }}/img/Gallery/26870845_1740142096076715_486825953067008000_n.jpg">
                            <div class="overlay">
                                <span class="ion-search"></span>
                            </div>
                        </div>
                        <div class="col" onclick="window.location.href='gallery.html'">
                            <img
                                src="{{ asset('frontend') }}/img/Gallery/27880266_1798970387070331_5621832064107020288_n.jpg">
                            <div class="overlay">
                                <span class="ion-search"></span>
                            </div>
                        </div>
                        <div class="col" onclick="window.location.href='gallery.html'">
                            <img
                                src="{{ asset('frontend') }}/img/Gallery/29415561_163922580940067_2417069708558729216_n.jpg">
                            <div class="overlay">
                                <span class="ion-search"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Tours -->

    <section class="section section-tour">
        <div class="section-head">
            <div class="section-line"></div>
            <h3 class="section-title">5 RECOMENDED TOURS</h3>
            <p class="section-subtitle">Wisata terbaik berdasarkan tingkat ketertarikan wisatawan Bali dan kepopuleran
                wisata tersebut</p>
        </div>
        <div class="section-tour-body">
            <div class="row">
                <div class="col-1 slides">
                    <img src="{{ asset('frontend') }}/img/pantai-kuta.jpg">
                    <div class="overlay">
                        <div class="caption">
                            <div class="caption-text">
                                <p>Kuta Beach</p>
                                <span class="ion-ios-star checked"></span>
                                <span class="ion-ios-star checked"></span>
                                <span class="ion-ios-star checked"></span>
                                <span class="ion-ios-star"></span>
                                <span class="ion-ios-star"></span> <br>
                                <span class="ion-bag big"></span> &nbsp;
                                <b>Rp. 15.000</b>
                                <a href="single-destination.html" class="btn btn-orange btn-round right">See
                                    Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1 slides">
                    <img src="{{ asset('frontend') }}/img/temple.jpg">
                    <div class="overlay">
                        <div class="caption">
                            <div class="caption-text">
                                <p>Pure Ulun Danu Bratan</p>
                                <span class="ion-ios-star checked"></span>
                                <span class="ion-ios-star checked"></span>
                                <span class="ion-ios-star checked"></span>
                                <span class="ion-ios-star"></span>
                                <span class="ion-ios-star"></span> <br>
                                <span class="ion-bag big"></span> &nbsp;
                                <b>Rp. 15.000</b>
                                <a href="single-destination.html" class="btn btn-orange btn-round right">See
                                    Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-2 slides">
                    <img src="{{ asset('frontend') }}/img/tanah-lot.jpeg">
                    <div class="overlay">
                        <div class="caption">
                            <div class="caption-text">
                                <p>Tanah Lot</p>
                                <span class="ion-ios-star checked"></span>
                                <span class="ion-ios-star checked"></span>
                                <span class="ion-ios-star checked"></span>
                                <span class="ion-ios-star checked"></span>
                                <span class="ion-ios-star"></span> <br>
                                <span class="ion-bag big"></span> &nbsp;
                                <b>Rp. 15.000 - Rp. 60.000</b> <br>
                                <a href="single-destination.html" class="btn btn-orange btn-round">See Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2 slides">
                    <img src="{{ asset('frontend') }}/img/bali-bird-park.jpg">
                    <div class="overlay">
                        <div class="caption">
                            <div class="caption-text">
                                <p>Bali Bird Park</p>
                                <span class="ion-ios-star checked"></span>
                                <span class="ion-ios-star checked"></span>
                                <span class="ion-ios-star checked"></span>
                                <span class="ion-ios-star"></span>
                                <span class="ion-ios-star"></span> <br>
                                <span class="ion-bag big"></span> &nbsp;
                                <b>Rp. 75.000 - Rp. 150.000</b> <br>
                                <a href="single-destination.html" class="btn btn-orange btn-round">See Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2 slides">
                    <img src="{{ asset('frontend') }}/img/gunung.jpg">
                    <div class="overlay">
                        <div class="caption">
                            <div class="caption-text">
                                <p>Mount Batur</p>
                                <span class="ion-ios-star checked"></span>
                                <span class="ion-ios-star checked"></span>
                                <span class="ion-ios-star checked"></span>
                                <span class="ion-ios-star"></span>
                                <span class="ion-ios-star"></span> <br>
                                <span class="ion-bag big"></span> &nbsp;
                                <b>Rp. 10.000</b> <br>
                                <a href="single-destination.html" class="btn btn-orange btn-round">See Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Newsletter -->

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
    </section>
@endsection
