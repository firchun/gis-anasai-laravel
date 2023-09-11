 <!-- Section About -->

 <section class="section section-about">
     <div class="about-head slides">
         <h3>Anasai Geografis</h3>
         <p> Cari lokasi wisata, events dan lapak di sini.....</p>
         {{-- <p><b>Bavel</b> merupakan singkatan dari <b>Bali Travel Time</b> merupakan website yang bertujuan
             mengenalkan pesona keindahan Bali mulai dari Wisata dan Budaya .
             Tidak hanya sarana untuk memperkanalkan, <b>Bavel</b> juga menyediakan berbagai layanan pemesanan tiket
             mulai tiket Tour dan tempat penginapan di sekitar Bali </p> --}}
     </div>
     <div class="about-body">
         <section class="my-3">
             <div id="gmap" style="height: 600px; width:100%;"></div>
         </section>
     </div>
 </section>
 @push('script')
     <script src="https://maps.googleapis.com/maps/api/js?&key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k"></script>
     <!-- Marker Clusterer Lib -->
     <script>
         var gmarkers1 = [];
         var markers1 = [];
         var infowindow = new google.maps.InfoWindow({
             content: ''
         });
         /**
          * Function to init map
          */
         function initialize() {
             var center = new google.maps.LatLng(-8.3983748, 140.4270463);
             var mapOptions = {
                 zoom: 12,
                 center: center,
                 zoomControl: true,
                 mapTypeId: google.maps.MapTypeId.HYBRID
             };
             map = new google.maps.Map(document.getElementById('gmap'), mapOptions);

             $.ajax({
                 url: "{{ route('get_all_desa') }}",
                 dataType: 'json',
                 method: 'GET',
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 success: function(response) {
                     markers1 = response.map(el => {
                         return {
                             "id": el['id'],
                             "nama": 'Desa ' + el['nama_desa'], // Sesuaikan dengan properti yang benar
                             "latitude": parseFloat(el['latitude']),
                             "longitude": parseFloat(el['longitude']),
                             "foto": el['foto_url'],
                             "jumlah_kk": el['jumlah_kk'] + ' Kepala Keluarga',
                             "jumlah_jiwa": el['jumlah_jiwa'] + ' Jiwa',
                             "keterangan": el['keterangan'],
                             "source": "desa",
                         }
                     });
                     for (i = 0; i < markers1.length; i++) {
                         addMarker(markers1[i]);
                     }
                 }
             });
             $.ajax({
                 url: "{{ route('get_all_kegiatan') }}",
                 dataType: 'json',
                 method: 'GET',
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 success: function(response) {
                     markers1 = response.map(el => {
                         return {
                             "id": el['id'],
                             "nama": 'Event ' + el[
                                 'nama_kegiatan'], // Sesuaikan dengan properti yang benar
                             "latitude": parseFloat(el['latitude']),
                             "longitude": parseFloat(el['longitude']),
                             "foto": el['foto_url'],
                             "source": "kegiatan",
                         }
                     });
                     for (i = 0; i < markers1.length; i++) {
                         addMarker(markers1[i]);
                     }
                 }
             });

         }
         /**
          * Function to add marker to map
          */
         function addMarker(marker) {

             var title = `${marker.nama}`;
             //  console.log(marker);
             var pos = new google.maps.LatLng(marker["latitude"], marker["longitude"]);

             var content = '';
             if (marker.source === 'desa') {
                 content = `
                            <div class="popupContent" style="width:200px;">
                                <div class="text-center justify-content-center text-black">
                                    <h1>${marker.nama}</h1>
                                    <img loading="lazy" class="img-fluid mb-3" style="height:100px;" src="${marker.foto}">
                                    <div style="margin-top:10px;">
                                        <strong>Jumlah KK : </strong>${marker.jumlah_kk}<br>
                                        <strong>Jumlah Jiwa : </strong>${marker.jumlah_jiwa}<br>
                                    </div>
                                    <div style="margin-top:10px;">
                                        <strong>Keterangan : </strong>
                                        <p>${marker.keterangan}</p>
                                    </div>
                                    <a href="https://maps.google.com/?saddr=My+Location&daddr=${marker.latitude},${marker.longitude}" target="_blank" class="btn btn-orange btn-round " style="margin-top:20px; margin-bottom:10px;">Rute</a>
                                </div>
                            </div>
                        `;
             } else {
                 content = `
                            <div class="popupContent"  style="width:200px;">
                                <div class="text-center justify-content-center text-black">
                                    <h1>${marker.nama}</h1>
                                    <img loading="lazy" class="img-fluid mb-3" style="height:100px;" src="${marker.foto}"><br>
                                    <a href="https://maps.google.com/?saddr=My+Location&daddr=${marker.latitude},${marker.longitude}" target="_blank" class="btn btn-orange btn-round " style="margin-top:20px; margin-bottom:10px;">Rute</a>
                                </div>
                            </div>
                        `;
             }
             //  var theIcon = `{{ asset('img/marker-merah.png') }}`;
             var theIcon =
                 `${marker.source === 'desa' ? '{{ asset('img/marker-merah.png') }}' : '{{ asset('img/marker-hijau.png') }}'}`;

             var icon = {
                 url: theIcon,
                 scaledSize: new google.maps.Size(25, 39)
             };
             marker1 = new google.maps.Marker({
                 title: title,
                 position: pos,
                 map: map,
                 icon: icon
             });
             gmarkers1.push(marker1);
             // Marker click listener
             google.maps.event.addListener(marker1, 'click', (function(marker1, content) {
                 return function() {
                     infowindow.setContent(content);
                     infowindow.open(map, marker1);
                     map.panTo(this.getPosition());
                 }
             })(marker1, content));
         }
         // console.log(marker);
         filterMarkers = function(category) {
             for (i = 0; i < gmarkers1.length; i++) {
                 marker = gmarkers1[i];
                 // If is same category or category not picked
                 if (marker.category == category || category.length === 0) {
                     //Close InfoWindows
                     marker.setVisible(true);
                     if (infowindow) {
                         infowindow.close();
                     }
                 }
                 // Categories don't match
                 else {
                     marker.setVisible(false);
                 }
             }
         }
         // Init map
         initialize();
     </script>
 @endpush
