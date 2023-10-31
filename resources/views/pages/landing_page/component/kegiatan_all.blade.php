  <!-- Section Discover -->

  <section class="section section-discover" id="discover">
      <div class="section-head">
          <div class="section-line"></div>
          <h3 class="section-title">Event di Sinai</h3>
          <p class="section-subtitle">Adalah sebuah warisan indahnya alam dan budaya yang masih terjaga di Sinai - Papua
              Selatan yang
              dapat anda jelajahi</p>
      </div>
      <div class="section-discover-body slides">
          <div class="container my-5">
              <div class="row justify-content-center">
                  @foreach ($kegiatan as $item)
                      <div class="col-lg-4 mb-3 ">
                          <div
                              style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px; border-radius:5px;">
                              <a href="{{ route('event.detail', $item->id) }}" class="zoom-hover">
                                  <div class="zoom-hover">
                                      <img src="{{ $item->foto ? Storage::url($item->foto) : asset('img/no-image.jpg') }}"
                                          class="card-img" alt="..." style="height: 300px; object-fit:cover;">
                                  </div>
                              </a>
                              <div class="p-3 text-center">
                                  <h5 class="mt-3 font-weight-bold">{{ $item->nama_kegiatan }}</h5>
                                  <div class="section-line mb-2"></div>
                                  <strong>Buka :</strong><br>
                                  <span class="p-1 bg-warning mb-3" style="border-radius:5px;">
                                      {{ $item->tanggal_mulai }} -
                                      {{ $item->tanggal_selesai }}
                                  </span>

                                  <div class="my-2">
                                      <strong>Keterangan :</strong><br>
                                      <span class="text-muted">
                                          {{ $item->keterangan ?? 'Keterangan tidak tersedia' }}
                                      </span>
                                  </div>
                                  <div class="mt-3">
                                      <a href="{{ route('event.detail', $item->id) }}"
                                          class="btn btn-orange btn-round py-2">Lihat
                                          Kegiatan</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
      </div>

  </section>
