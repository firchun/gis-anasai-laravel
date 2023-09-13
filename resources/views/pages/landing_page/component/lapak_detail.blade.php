  <!-- Section Discover -->

  <section class="section section-discover" style="margin-bottom: 20px;">
      <div class="section-head">
          <div class="section-line"></div>
          <h3 class="section-title">{{ $title }}</h3>

      </div>
      <div class="container">
          <div style="margin-bottom:20px; " class="text-center">

              <img src="{{ $produk_lapak->foto ? Storage::url($produk_lapak->foto) : asset('img/no-image.jpg') }}"
                  alt="Destination">
          </div>
          <strong>Informasi Merchandise :</strong><br>
          <p>{{ $produk_lapak->keterangan }}</p>
      </div>
  </section>
