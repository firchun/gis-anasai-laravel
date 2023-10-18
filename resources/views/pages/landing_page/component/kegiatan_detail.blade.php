  <!-- Section Discover -->

  <section class="section section-discover" style="margin-bottom: 20px;">
      <div class="section-head">
          <div class="section-line"></div>
          <h3 class="section-title">{{ $title }}</h3>

      </div>
      <div style="margin-bottom:20px; " class="text-center">

          <img src="{{ $kegiatan->foto ? Storage::url($kegiatan->foto) : asset('img/no-image.jpg') }}" alt="Destination"
              style="border-radius: 20px; box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">
      </div>
      <div class="container">
          <strong>Informasi event :</strong><br>
          <p>{{ $kegiatan->keterangan }}</p>
      </div>
  </section>
