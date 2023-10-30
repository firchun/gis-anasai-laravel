<section class="section section-discover" style="margin-bottom: 20px;">

    <section class="section-explore mb-4"
        style="height: 500px; background-image:url({{ $kegiatan->foto ? Storage::url($kegiatan->foto) : asset('img/no-image.jpg') }}); ">
        <div class="texture-handler-top"></div>
        <div class="overlay" style="background:transparent;">
            <div class="caption">
                <img src="{{ $kegiatan->foto ? Storage::url($kegiatan->foto) : asset('img/no-image.jpg') }}"
                    alt="image" style="max-height: 500px; max-width:300px; border-radius:20px;"
                    class="d-md-none  shadow-lg">
                <!-- Ubah kelas d-md-block menjadi d-md-none -->
            </div>
        </div>
        <div class="texture-handler-bottom"></div>
    </section>
    <div class="mx-5 mt-4">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h5 class="text-left font-weight-bold underline-half mb-4">Detail Event :</h5>
                <div id="map" style="height: 300px; width:100%;"></div>
                <a href="https://maps.google.com/?saddr=My+Location&daddr=${marker.latitude},${marker.longitude}"
                    target="_blank" class="btn btn-orange btn-round "
                    style="margin-top:20px; margin-bottom:10px; padding:5px 10px;">Rute menuju Event</a>
            </div>
            <div class="col-lg-8">
                <h5 class="text-left font-weight-bold underline-half mb-4">Informasi Event :</h5>
                <div class="row">
                    <p>{{ $kegiatan->keterangan }}</p>
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
                lat: {{ $kegiatan->latitude }},
                lng: {{ $kegiatan->longitude }}
            }; // Ganti dengan koordinat Anda

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 11, // Tingkat Zoom
                center: myLatLng
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: {
                    url: '{{ asset('img/marker-hijau.png') }}', // Ganti dengan path gambar marker Anda
                    scaledSize: new google.maps.Size(28, 39) // Tentukan ukuran ikon di sini (lebar x tinggi)
                }
            });
        }
        initMap();
    </script>
@endpush
