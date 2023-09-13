  <!-- Section Discover -->

  <section class="section section-discover" style="margin-bottom: 20px;">
      <div class="section-head">
          <div class="section-line"></div>
          <h3 class="section-title">{{ $title }}</h3>

      </div>
      <div class="container">
          <div style="margin-bottom:20px; " class="text-center">

              <img src="{{ $desa->foto ? Storage::url($desa->foto) : asset('img/no-image.jpg') }}" alt="Destination">
          </div>
          <strong>Informasi Desa :</strong><br>
          <p>{{ $desa->keterangan }}</p>
      </div>
  </section>
