  <!-- Section Discover -->



  <section class="section section-discover" style="margin-bottom: 20px;">

      <section class="section-explore mb-4"
          style="height: 500px; background-image:url({{ $wisata->foto ? Storage::url($wisata->foto) : asset('img/no-image.jpg') }}); ">
          <div class="texture-handler-top"></div>
          <div class="overlay" style="background:transparent;">
              <div class="caption">
                  <img src="{{ $wisata->foto ? Storage::url($wisata->foto) : asset('img/no-image.jpg') }}" alt="image"
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
                  <h5 class="text-left font-weight-bold underline-half mb-4">Detail Wisata :</h5>
                  <div id="map" style="height: 300px; width:100%;"></div>
                  <a href="https://maps.google.com/?saddr=My+Location&daddr={{ $wisata->latitude }},{{ $wisata->longitude }}"
                      target="_blank" class="btn btn-orange btn-round "
                      style="margin-top:20px; margin-bottom:10px; padding:5px 10px;">Rute menuju wisata</a>
                  {{-- <hr class="my-3">
                  <div class="mt-3 px-2">
                      <h5 class="text-left font-weight-bold underline-half mb-4">Ulasan dan Rating Pengguna:</h5>
                      @guest
                          <a href="{{ route('login') }}" class="btn btn-primary py-2 btn-block">Login untuk memeberikan
                              ulasan anda</a>
                      @else
                          <form class="" action="{{ route('review.store') }}" method="POST"
                              enctype="multipart/form-data">
                              @csrf
                              <div class="">
                                  <div class="form-group row d-flex justify-content-center">
                                      <input type="hidden" name="identity" value="{{ $wisata->id }}">
                                      <input type="hidden" name="type" value="wisata">
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
                          @forelse (App\Models\reviewRating::where('identity',$wisata->id)->where('type','wisata')->get() as $rating)
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

                  </div> --}}
              </div>
              <div class="col-lg-6 mb-4" style="min-height: 300px;">
                  <h5 class="text-left font-weight-bold underline-half mb-4">Informasi Wisata :</h5>
                  <p>
                      <strong>Harga Tiket Masuk : </strong>
                  <h2>{!! strlen($wisata->harga) > 2
                      ? 'Rp ' . number_format($wisata->harga)
                      : '<span class="text-danger">Gratis</span>' !!}</h2>
                  <strong>Keterangan : </strong> {{ $wisata->keterangan }}
                  </p>
                  <div class="mt-3">
                      @php
                          $foto = App\Models\WisataFoto::where('id_wisata', $wisata->id)->get();
                      @endphp
                      @if ($foto->count() != 0)
                          <h5 class="text-left font-weight-bold underline-half mb-4">Foto Wisata :</h5>
                          <div class="row">
                              @foreach ($foto as $f)
                                  <div class="col-lg-6">
                                      <div class="card border-0">
                                          <div class="card-body">
                                              <img src="{{ Storage::url($f->foto) }}" alt="{{ $f->title }}"
                                                  height="200">
                                          </div>
                                      </div>
                                  </div>
                              @endforeach
                          </div>
                      @endif
                  </div>

              </div>
              <div class="col-lg-3">
                  <div class="mt-3 px-2">
                      <h5 class="text-left font-weight-bold underline-half mb-4">Ulasan dan Rating Pengguna:</h5>
                      @guest
                          <a href="{{ route('login') }}" class="btn btn-primary py-2 btn-block">Login untuk memeberikan
                              ulasan anda</a>
                      @else
                          <form class="" action="{{ route('review.store') }}" method="POST"
                              enctype="multipart/form-data">
                              @csrf
                              <div class="">
                                  <div class="form-group row d-flex justify-content-center">
                                      <input type="hidden" name="identity" value="{{ $wisata->id }}">
                                      <input type="hidden" name="type" value="wisata">
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
                          @forelse (App\Models\reviewRating::where('identity',$wisata->id)->where('type','wisata')->get() as $rating)
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
                  lat: {{ $wisata->latitude }},
                  lng: {{ $wisata->longitude }}
              }; // Ganti dengan koordinat Anda

              var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 11, // Tingkat Zoom
                  center: myLatLng
              });

              var marker = new google.maps.Marker({
                  position: myLatLng,
                  map: map,
                  icon: {
                      url: '{{ asset('img/marker-wisata.png') }}', // Ganti dengan path gambar marker Anda
                      scaledSize: new google.maps.Size(28, 39) // Tentukan ukuran ikon di sini (lebar x tinggi)
                  }
              });
          }
          initMap();
      </script>
  @endpush
