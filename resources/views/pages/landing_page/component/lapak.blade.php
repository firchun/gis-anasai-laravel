 <!-- Section Tours -->

 <section class="section  " style="padding-bottom: 50px;">
     <div class="section-head">
         <div class="section-line"></div>
         <h3 class="section-title">REKOMENDASI OLEH-OLEH KHAS SINAI</h3>
         <p class="section-subtitle">Dapatkan oleh-oleh khas dari Sinai yang sangat menarik untuk anda bawa...</p>
     </div>
     <div class="container ">
         <div class="row justify-content-center ">
             @if ($lapak != null)
                 @foreach ($lapak as $item)
                     <div class="col-lg-4 mb-2">
                         <div
                             style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px; border-radius:5px;">
                             <a href="{{ route('shop.detail', $item->id) }}" class="zoom-hover">
                                 <div class="zoom-hover">
                                     <img src="{{ $item->foto ? Storage::url($item->foto) : asset('img/no-image.jpg') }}"
                                         class="card-img" alt="..." style="height: 300px; object-fit:cover;">
                                 </div>
                             </a>
                             <div class="p-3 text-center">
                                 <h5 class="mt-3 font-weight-bold">{{ $item->nama_lapak }}</h5>
                                 <div class="section-line mb-2"></div>
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
                                 <div class="my-2">
                                     <strong>Keterangan :</strong>
                                     <span class="text-muted">
                                         {{ $item->keterangan ?? 'Keterangan tidak tersedia' }}
                                     </span>
                                 </div>
                                 <div class="mt-3">
                                     <a href="{{ route('shop.detail', $item->id) }}"
                                         class="btn btn-orange btn-round py-2">Lihat
                                         Lapak</a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 @endforeach
                 <div class="text-center">
                     <a href="{{ route('shop') }}" class="btn btn-orange btn-round mt-3 py-2">Semua
                         Lapak..</a>
                 </div>
             @else
                 <div class="col-12">
                     <div class="mt-4">
                         <center>
                             <h3>Belum ada produk dari toko ini..</h3>
                         </center>
                     </div>
                 </div>
             @endif
         </div>
     </div>
 </section>
