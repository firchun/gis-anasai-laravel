  <!-- Section Discover -->

  <section class="section" id="discover">
      <div class="section-head">
          <h3 class="section-title">Desa di Kawasan Sinai</h3>
          <p class="section-subtitle">Adalah desa-desa yang berapa pada kawasan sinai - Papua Selatan </p>
          <div class="section-line"></div>
      </div>
      <div class=" slides my-4">
          <div class="section-discover-body container">
              <div class="row justify-content-center align-items-center">
                  @foreach ($desa as $item)
                      <div class="col-lg-4 mb-3">
                          <a href="{{ route('village.detail', $item->id) }}" class="zoom-hover">
                              <div class="card text-white">
                                  <div class="position-relative">
                                      <img src="{{ $item->foto ? Storage::url($item->foto) : asset('img/no-image.jpg') }}"
                                          class="card-img" alt="...">
                                      <div class="card-img-overlay d-flex flex-column justify-content-end text-center">
                                          <h5 class="card-title mb-0 font-weight-bold">Desa {{ $item->nama_desa }}</h5>
                                          {{-- <p class="card-text">
                                          <mark>{{ $item->keterangan ?? 'Keterangan tidak tersedia' }}</mark>
                                      </p> --}}
                                      </div>
                                  </div>
                              </div>
                          </a>
                      </div>
                  @endforeach
              </div>
          </div>
      </div>

  </section>
