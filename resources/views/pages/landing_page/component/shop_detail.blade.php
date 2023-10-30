<section class="section section-discover" style="margin-bottom: 20px;">

    <section class="section-explore mb-4"
        style="height: 500px; background-image:url({{ $toko->foto ? Storage::url($toko->foto) : asset('img/no-image.jpg') }}); ">
        <div class="texture-handler-top"></div>
        <div class="overlay" style="background:transparent;">
            <div class="caption">
                <img src="{{ $toko->foto ? Storage::url($toko->foto) : asset('img/no-image.jpg') }}" alt="image"
                    style="max-height: 500px; max-width:300px; border-radius:20px;" class="d-md-none  shadow-lg">
                <!-- Ubah kelas d-md-block menjadi d-md-none -->
            </div>
        </div>
        <div class="texture-handler-bottom"></div>
    </section>
    <div class="mx-5 mt-4">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h5 class="text-left font-weight-bold underline-half mb-4">Detail Toko :</h5>
                <div id="map" style="height: 300px; width:100%;"></div>
                <a href="https://maps.google.com/?saddr=My+Location&daddr=${marker.latitude},${marker.longitude}"
                    target="_blank" class="btn btn-orange btn-round "
                    style="margin-top:20px; margin-bottom:10px; padding:5px 10px;">Rute menuju tempat wisata</a>
            </div>
            <div class="col-lg-8">
                <h5 class="text-left font-weight-bold underline-half mb-4">Produk Toko :</h5>
                <div class="row">
                    @if ($produk_toko != null)
                        @foreach ($produk_toko as $item)
                            <div class="col-lg-4 mb-4">
                                <div class="card "
                                    style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; border-radius:10px;">
                                    <img src="{{ $item->foto ? Storage::url($item->foto) : asset('img/no-image.jpg') }}"
                                        class="card-img-top" alt="..."
                                        style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                    <div class="card-body">
                                        <h5 class="card-title ">{{ $item->nama_produk }}</h5>
                                        <span class="card-text">
                                            <span class="ion-ios-star checked"></span>
                                            <span class="ion-ios-star checked"></span>
                                            <span class="ion-ios-star checked"></span>
                                            <span class="ion-ios-star checked"></span>
                                            <span class="ion-ios-star"></span>
                                        </span><br>
                                        <span class="card-text text-primary"><b>Rp.
                                                {{ number_format($item->harga) }}</b></span><br>
                                        <a href="{{ route('merchandise.detail', $item->id) }}"
                                            class="btn btn-orange btn-round mt-2">Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="mt-4">
                                <center>
                                    <h3>Belum ada produk dari toko ini..</h3>
                                </center>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>

    </div>
</section>
@push('script')
    <script src="https://maps.googleapis.com/maps/api/js?&key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k"></script>
    <script>
        function initMap() {
            var myLatLng = {
                lat: {{ $toko->latitude }},
                lng: {{ $toko->longitude }}
            }; // Ganti dengan koordinat Anda

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 11, // Tingkat Zoom
                center: myLatLng
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: {
                    url: '{{ asset('img/marker-lapak.png') }}', // Ganti dengan path gambar marker Anda
                    scaledSize: new google.maps.Size(28, 39) // Tentukan ukuran ikon di sini (lebar x tinggi)
                }
            });
        }
        initMap();
    </script>
@endpush
