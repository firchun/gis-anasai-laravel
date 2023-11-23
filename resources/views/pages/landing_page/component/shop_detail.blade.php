<section class="section section-discover" style="margin-bottom: 20px;">

    <section class="section-explore mb-4"
        style="height: 500px; background-image:url({{ $toko->foto ? Storage::url($toko->foto) : asset('img/no-image.jpg') }}); ">
        <div class="texture-handler-top"></div>
        <div class="overlay" style="background:transparent;">
            <div class="caption">
                <img src="{{ $toko->foto ? Storage::url($toko->foto) : asset('img/no-image.jpg') }}" alt="image"
                    style="max-height: 500px; max-width:300px; border-radius:20px;" class="d-md-none  shadow-lg"
                    loading="lazy">
                <!-- Ubah kelas d-md-block menjadi d-md-none -->
            </div>
        </div>
        <div class="texture-handler-bottom"></div>
    </section>
    <div class="mx-5 mt-4">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <h5 class="text-left font-weight-bold underline-half mb-4">Detail Toko :</h5>
                <div id="map" style="height: 300px; width:100%;"></div>
                <a href="https://maps.google.com/?saddr=My+Location&daddr={{ $toko->latitude }},{{ $toko->longitude }}"
                    target="_blank" class="btn btn-orange btn-round "
                    style="margin-top:20px; margin-bottom:10px; padding:5px 10px;">Rute menuju tempat wisata</a>
                <a href="{{ route('chat', $toko->id_user) }}" class="btn btn-primary btn-round "
                    style="margin-top:20px; margin-bottom:10px; padding:5px 10px;">Chat Lapak</a>
                {{-- <hr class="my-3"> --}}

            </div>
            <div class="col-lg-6 mb-4 " style="min-height: 300px;">
                <h5 class="text-left font-weight-bold underline-half mb-4">Produk Toko :</h5>
                <div class="row">
                    @if ($produk_toko != null)
                        @foreach ($produk_toko as $item)
                            <div class="col-lg-4 mb-4">
                                <div class="card "
                                    style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; border-radius:10px;">
                                    <img src="{{ $item->foto ? Storage::url($item->foto) : asset('img/no-image.jpg') }}"
                                        class="card-img-top" alt="..."
                                        style="border-top-left-radius: 10px; border-top-right-radius: 10px; height: 300px; object-fit:cover;"
                                        loading="lazy">
                                    <div class="card-body">
                                        <h5 class="card-title " style="color: #f25601">{{ $item->nama_produk }}</h5>
                                        <span class="card-text text-primary"><b>Rp.
                                                {{ number_format($item->harga) }}</b></span><br>
                                        {{-- <button type="button" class="btn btn-orange btn-round mt-2"
                                            data-toggle="modal" data-target="#detailsModal{{ $item->slug }}">
                                            Details
                                        </button> --}}
                                    </div>
                                </div>
                            </div>
                            {{-- modal  --}}
                            <div class="modal fade" id="detailsModal{{ $item->slug }}" tabindex="-1" role="dialog"
                                aria-labelledby="detailsModalLabel{{ $item->slug }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailsModalLabel">{{ $item->nama_produk }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ $item->foto ? Storage::url($item->foto) : asset('img/no-image.jpg') }}"
                                                class="card-img-top" alt="..."
                                                style="border-top-left-radius: 10px; border-top-right-radius: 10px;"
                                                loading="lazy">
                                        </div>

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
            <div class="col-lg-3">
                <div class="mt-3 px-2">
                    <h5 class="text-left font-weight-bold underline-half mb-4">Ulasan dan Rating Pengguna:</h5>
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-primary py-2 btn-block">Login untuk memeberikan
                            ulasan
                            anda</a>
                    @else
                        <form class="" action="{{ route('review.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="">
                                <div class="form-group row d-flex justify-content-center">
                                    <input type="hidden" name="identity" value="{{ $toko->id }}">
                                    <input type="hidden" name="type" value="lapak">
                                    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                    <div class="">
                                        <div class="rate">
                                            <input type="radio" id="star5" class="rate" name="star_rating"
                                                value="5" />
                                            <label for="star5" title="5 stars">5 stars</label>
                                            <input type="radio" id="star4" class="rate" name="star_rating"
                                                value="4" />
                                            <label for="star4" title="4 stars">4 stars</label>
                                            <input type="radio" id="star3" class="rate" name="star_rating"
                                                value="3" />
                                            <label for="star3" title="3 stars">3 stars</label>
                                            <input type="radio" id="star2" class="rate" name="star_rating"
                                                value="2">
                                            <label for="star2" title="2 stars">2 stars</label>
                                            <input type="radio" id="star1" class="rate" name="star_rating"
                                                value="1" />
                                            <label for="star1" title="1 stars">1 star</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-12">
                                        <textarea class="form-control" name="comments" rows="2 " placeholder="Ulasan anda" maxlength="200"></textarea>
                                    </div>
                                </div>
                                <button class="btn py-2 px-3 btn-success">Submit
                                </button>
                            </div>
                        </form>
                    @endguest
                    <hr class="my-3">
                    <div class="py-3 px-2 " style="background-color: #f8f8f8; border-radius:5px;">
                        @forelse (App\Models\reviewRating::where('identity',$toko->id)->where('type','lapak')->latest()->get() as $rating)
                            <strong style="color: #f25601">{{ $rating->user->name }} : </strong>
                            <br><small style="font-size:10px;">{{ $rating->created_at->diffFOrHumans() }}</small>
                            <div class="form-group my-2">
                                <div class="ratings">
                                    @for ($i = 1; $i <= $rating->star_rating; $i++)
                                        <i class="ion-star icon text-warning h1"></i>
                                    @endfor
                                </div>
                            </div>
                            <div class="form-group">
                                <span>{{ $rating->comments }}</span>
                            </div>
                            <hr>
                        @empty
                            <span class="text-center text-muted">Belum ada ulasan pelanggan</span>
                        @endforelse
                    </div>

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
