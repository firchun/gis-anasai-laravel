<section class="section section-discover" style="margin-bottom: 20px;">
    <div class="section-head">
        <div class="section-line"></div>
        <h3 class="section-title">{{ $title }}</h3>

    </div>
    <div style="margin-bottom:20px; " class="text-center">

        <img src="{{ $toko->foto ? Storage::url($toko->foto) : asset('img/no-image.jpg') }}" alt="Destination"
            style="border-radius: 20px; box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">
    </div>
    <div class="container">
        <h2 class="text-center">Produk Toko :</h2><br>

        <div class="section-tour-body">
            <div class="row">
                @if ($produk_toko)
                    @foreach ($produk_toko as $item)
                        <div class="col-1 slides">
                            <img src="{{ $item->foto ? Storage::url($item->foto) : asset('img/no-image.jpg') }}">
                            <div class="overlay">
                                <div class="caption">
                                    <div class="caption-text">
                                        <p>{{ $item->nama_produk }}</p>
                                        <small>Lapak : {{ $item->lapak->nama_lapak }}, Milik :
                                            {{ $item->lapak->user->name }}</small><br>
                                        <span class="ion-ios-star checked"></span>
                                        <span class="ion-ios-star checked"></span>
                                        <span class="ion-ios-star checked"></span>
                                        <span class="ion-ios-star"></span>
                                        <span class="ion-ios-star"></span> <br>
                                        <span class="ion-bag big"></span> &nbsp;
                                        <b>Rp. {{ number_format($item->harga) }}</b>
                                        <a href="{{ route('merchandise.detail', $item->id) }}"
                                            class="btn btn-orange btn-round right "> Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="mt-4">
                        <center>
                            <h3>Belum ada produk dari toko ini..</h3>
                        </center>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
