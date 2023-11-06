  <!-- Section Discover -->

  <section class="section my-4 mx-auto" id="discover" style="background:#f5f7fc;">
      <div class="section-head">
          <div class="section-line"></div>
          <h3 class="section-title">Desa di Kawasan Sinai</h3>
          <p class="section-subtitle">Adalah desa-desa yang berapa pada kawasan sinai - Papua Selatan </p>
      </div>
      <div class="section-discover-body container">
          <div class="row justify-content-center align-items-center">
              @foreach ($desa->take(3) as $item)
                  <div class="col-lg-4">
                      <a href="{{ route('village.detail', $item->slug) }}">
                          <div class="card text-white">
                              <div class="position-relative">
                                  <img src="{{ $item->foto ? Storage::url($item->foto) : asset('img/no-image.jpg') }}"
                                      class="card-img" alt="..." loading="lazy">
                                  <div class="gradient-overlay">
                                  </div>
                                  <div class="card-img-overlay d-flex flex-column justify-content-end text-center ">
                                      <h5 class="card-title mb-0 font-weight-bold">Desa {{ $item->nama_desa }}</h5>
                                      <div class="section-line"></div>
                                      <p class="card-text">
                                          {{ Str::limit($item->keterangan, 30) ?? 'Keterangan tidak tersedia' }}
                                      </p>
                                  </div>

                              </div>
                          </div>
                      </a>
                  </div>
              @endforeach
          </div>
      </div>
      <div class="text-center" style="margin-top:20px; margin-bottom:20px;">
          <a href="{{ url('/village') }}" class="btn btn-orange btn-round">Tampilkan lainnya..</a>
      </div>
      <svg class="hero-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none"
          style="height: 50px; width:100%;">
          <path fill="#ffffff" d="M0 10 0 0 A 90 59, 0, 0, 0, 100 0 L 100 10 Z"></path>
      </svg>
  </section>
