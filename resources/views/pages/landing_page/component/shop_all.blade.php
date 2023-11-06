  <!-- Section Discover -->

  <section class="section section-discover " id="discover">
      <div class="section-head">
          <div class="section-line"></div>
          <h3 class="section-title">Lapak di Kawasan Sinai</h3>
          {{-- <p class="section-subtitle">Adalah sebuah warisan indahnya alam dan budaya yang masih terjaga di Sinai - Papua
            Selatan yang
            dapat anda jelajahi</p> --}}
      </div>
      <div class="container my-5">
          <div class="row justify-content-center ">
              @foreach ($lapak as $item)
                  <div class="col-lg-4 mb-3">
                      <div
                          style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px; border-radius:5px;">
                          <a href="{{ route('shop.detail', $item->slug) }}" class="zoom-hover">
                              <div class="zoom-hover">
                                  <img src="{{ $item->foto ? Storage::url($item->foto) : asset('img/no-image.jpg') }}"
                                      class="card-img" alt="..." style="height: 300px; object-fit:cover;"
                                      loading="lazy">
                              </div>
                          </a>
                          <div class="p-3 text-center">
                              <h5 class="mt-3 font-weight-bold">{{ $item->nama_lapak }}</h5>
                              <div class="section-line mb-2"></div>
                              <div class="d-flex justify-content-center">
                                  @php
                                      $rating = App\Models\reviewRating::where('identity', $item->id)->where('type', 'lapak');
                                      $review = $rating->count();
                                      $average_rating = $rating->avg('star_rating');
                                      $total_rating = round($average_rating);
                                  @endphp
                                  @if ($total_rating != 0)
                                      @for ($i = 1; $i <= $total_rating; $i++)
                                          <i class="ion-star icon text-warning h3"></i>
                                      @endfor
                                  @else
                                      @for ($i = 1; $i <= 5; $i++)
                                          <i class="ion-star icon text-muted h3"></i>
                                      @endfor
                                  @endif
                              </div>
                              <small class="text-muted">{{ $review . ' Ulasan' }}</small><br>
                              @php
                                  $produk = App\Models\ProdukLapak::where('id_lapak', $item->id)->count();
                              @endphp
                              @if ($produk != 0)
                                  <span class="p-1 bg-warning mb-3" style="border-radius:5px;">
                                      Tersedia {{ $produk }} produk
                                  </span>
                              @else
                                  <span class="p-1 bg-danger mb-3" style="border-radius:5px;">
                                      Belum tersedia
                                  </span>
                              @endif
                              <div class="my-2">
                                  <strong>Pemilik :</strong> {{ $item->user->name }}
                              </div>
                              <div class="my-2">
                                  <strong>Hp :</strong> <a target="_blank"
                                      href="https://wa.me/">{{ $item->user->phone }}</a>
                              </div>
                              @if ($item->keterangan)
                                  <div class="my-2">
                                      <strong>Keterangan :</strong>
                                      <span class="text-muted">
                                          {{ Str::limit($item->keterangan, 50) }}
                                      </span>
                                  </div>
                              @endif
                              <div class="mt-3">
                                  <a href="{{ route('shop.detail', $item->slug) }}"
                                      class="btn btn-orange btn-round py-2">Lihat
                                      Lapak</a>
                              </div>
                          </div>
                      </div>
                  </div>
              @endforeach
          </div>
          <div class="mt-4 text-center">
              {{ $lapak->links('vendor.pagination.bootstrap-5') }}
          </div>

      </div>

  </section>
