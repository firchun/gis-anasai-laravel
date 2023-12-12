{{-- <section class="section section-discover" style="margin-bottom: 20px;">
    <div class="section-head">
        <div class="section-line"></div>
        <h3 class="section-title">{{ $title }}</h3>

    </div>
    <div style="margin-bottom:20px; " class="text-center">

        <img src="{{ $desa->foto ? Storage::url($desa->foto) : asset('img/no-image.jpg') }}" alt="Destination"
            style="border-radius: 20px; box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            height:500px; ">
    </div>
    <div class="container">
        <h2 class="text-center">Informasi Desa :</h2><br>
        <p class="mb-3">{{ $desa->keterangan }}</p>
        @if (App\Models\DesaDetail::where('id_desa', $desa->id)->first() != null)
            <hr>
            <h2 class="text-center">Monografi {{ $title }}</h2>
            <table class="table table-bordered" style="width: 100%; border:1px;">
                @foreach (json_decode(App\Models\DesaDetail::where('id_desa', $desa->id)->first()->data) as $detail)
                    <tr>
                        <td style="width:300px;"><strong>{{ $detail->title }}</strong></td>
                        <td>{{ $detail->description }}</td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
</section> --}}

<section class="section section-discover" style="margin-bottom: 20px;">

    <section class="section-explore mb-4"
        style="height: 500px; background-image:url({{ $desa->foto ? Storage::url($desa->foto) : asset('img/no-image.jpg') }}); ">
        <div class="texture-handler-top"></div>
        <div class="overlay" style="background:transparent;">
            <div class="caption">
                <img src="{{ $desa->foto ? Storage::url($desa->foto) : asset('img/no-image.jpg') }}" alt="image"
                    style="max-height: 500px; max-width:300px; border-radius:20px;" class="d-md-none  shadow-lg"
                    loading="lazy">
                <!-- Ubah kelas d-md-block menjadi d-md-none -->
            </div>
        </div>
        <div class="texture-handler-bottom"></div>
    </section>
    <div class="mx-5 mt-4">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h5 class="text-left font-weight-bold underline-half mb-4">Detail Desa :</h5>
                <div id="map" style="height: 300px; width:100%;"></div>
                <a href="https://maps.google.com/?saddr=My+Location&daddr={{ $desa->latitude }},{{ $desa->longitude }}"
                    target="_blank" class="btn btn-orange btn-round "
                    style="margin-top:20px; margin-bottom:10px; padding:5px 10px;">Rute menuju desa</a>
            </div>
            <div class="col-lg-8" style="min-height: 300px;">
                <h5 class="text-left font-weight-bold underline-half mb-4">Monografi Desa :</h5>
                <div class="row">
                    <table class="table table-bordered mb-3" style="width: 100%; border:1px;">
                        <tr class="bg-warning">
                            <td colspan="2" class="text-center "><strong>A. DATA STATIS DESA</strong></td>
                        </tr>
                        <tr>
                            <td style="width:300px;"> <strong>Nama Desa</strong></td>
                            <td> {{ $desa->nama_desa }} </td>
                        </tr>
                        <tr>
                            <td style="width:300px;"> <strong>Jumlah Kepala Keluarga</strong></td>
                            <td> {{ $desa->jumlah_kk }} KK</td>
                        </tr>
                        <tr>
                            <td style="width:300px;"> <strong>Jumlah Jiwa</strong></td>
                            <td> {{ $desa->jumlah_jiwa }} Jiwa</td>
                        </tr>
                        <tr>
                            <td style="width:300px;"> <strong>Keterangan</strong></td>
                            <td> {{ $desa->keterangan }}</td>
                        </tr>
                    </table>
                    @if (App\Models\DesaDetail::where('id_desa', $desa->id)->first() != null)
                        <table class="table table-bordered" style="width: 100%; border:1px;">
                            <tr class="bg-warning">
                                <td colspan="2" class="text-center "><strong>B. DATA UMUM DESA</strong></td>
                            </tr>
                            @foreach (json_decode(App\Models\DesaDetail::where('id_desa', $desa->id)->first()->data) as $detail)
                                @if ($detail->title != null && $detail->description != null)
                                    <tr>
                                        <td style="width:300px;"><strong>{{ $detail->title }}</strong></td>
                                        <td>{{ $detail->description }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
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
                lat: {{ $desa->latitude }},
                lng: {{ $desa->longitude }}
            }; // Ganti dengan koordinat Anda

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 11, // Tingkat Zoom
                center: myLatLng
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: {
                    url: '{{ asset('img/marker-merah.png') }}', // Ganti dengan path gambar marker Anda
                    scaledSize: new google.maps.Size(28, 39) // Tentukan ukuran ikon di sini (lebar x tinggi)
                }
            });
        }
        initMap();
    </script>
@endpush
