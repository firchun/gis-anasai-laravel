 <!-- Section Tours -->

 <section class="section section-tour " style="padding-bottom: 50px;">
     <div class="section-head">
         <div class="section-line"></div>
         <h3 class="section-title">REKOMENDASI MERCHANDISE DI ANASAI</h3>
         <p class="section-subtitle">Dapatkan oleh-oleh khas dari Anasai yang sangat menarik untuk anda bawa...</p>
     </div>
     <div class="section-tour-body">
         <div class="row">
             @foreach ($produk_lapak as $item)
                 <div class="col-2 slides slideanim">
                     <img src="{{ $item->foto ? Storage::url($item->foto) : asset('img/no-image.jpg') }}">
                     <div class="overlay">
                         <div class="caption">
                             <div class="caption-text">
                                 <strong>{{ $item->nama_produk }}</strong><br>
                                 <span class="ion-ios-star checked"></span>
                                 <span class="ion-ios-star checked"></span>
                                 <span class="ion-ios-star checked"></span>
                                 <span class="ion-ios-star checked"></span>
                                 <span class="ion-ios-star"></span> <br>
                                 <span class="ion-bag big"></span> &nbsp;
                                 <b>Rp. {{ number_format($item->harga) }}</b>
                                 <a href="{{ route('merchandise.detail', $item->id) }}"
                                     class="btn btn-orange btn-round right "> Details</a>
                             </div>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>
     </div>
 </section>
