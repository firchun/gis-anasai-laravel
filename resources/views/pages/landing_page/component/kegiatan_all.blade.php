  <!-- Section Discover -->

  <section class="section section-discover" id="discover">
      <div class="section-head">
          <div class="section-line"></div>
          <h3 class="section-title">Event di Anasai</h3>
          <p class="section-subtitle">Adalah sebuah warisan indahnya alam dan budaya yang masih terjaga di Anasai - Papua
              Selatan yang
              dapat anda jelajahi</p>
      </div>
      <div class="section-discover-body slides">
          @foreach ($kegiatan as $item)
              <div class="col">
                  <a href="destination.html">
                      <img src="{{ $item->foto ? Storage::url($item->foto) : asset('img/no-image.jpg') }}"
                          alt="Destination">
                      <div class="caption">
                          <p>{{ $item->nama_kegiatan }}</p>
                          <div class="line"></div>
                          <div class="caption-text">
                              <p>{{ $item->keterangan ?? 'Keterangan tidak tersedia' }}</p>
                          </div>
                      </div>
                  </a>
              </div>
          @endforeach

      </div>

  </section>
