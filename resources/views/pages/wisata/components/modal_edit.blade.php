<div class="modal fade" id="edit-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Update Data') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="{{ route('desa.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group ">
                        <label class="form-control-label" for="foto">Foto Desa<span
                                class="small text-danger">*</span></label>
                        <input type="file" class="form-control" name="foto">
                    </div>
                    <div class="form-group ">
                        <label class="form-control-label" for="nama_desa">Nama Desa<span
                                class="small text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_desa" placeholder="Nama Desa"
                            value="{{ $item->nama_desa }}">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group ">
                                <label class="form-control-label" for="jumlah_kk">Jumlah KK<span
                                        class="small text-danger">*</span></label>
                                <input type="number" class="form-control" name="jumlah_kk" placeholder="0"
                                    value="{{ $item->jumlah_kk }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group ">
                                <label class="form-control-label" for="jumlah_jiwa">Jumlah Jiwa<span
                                        class="small text-danger">*</span></label>
                                <input type="number" class="form-control" name="jumlah_jiwa" placeholder="0"
                                    value="{{ $item->jumlah_jiwa }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="form-control-label" for="keterangan">Keterangan Tambahan<span
                                class="small text-danger">*</span></label>
                        <textarea name="keterangan" class="form-control">{{ $item->keterangan }}</textarea>
                    </div>
                    <div id="map-edit-{{ $item->id }}" style="height: 300px;"></div>
                    <input type="hidden" name="latitude" id="latitude-edit-{{ $item->id }}"
                        value="{{ $item->latitude }}">
                    <input type="hidden" name="longitude" id="longitude-edit-{{ $item->id }}"
                        value="{{ $item->longitude }}">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Simpan Perubahan') }}</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@push('js')
    <script>
        function initMapEdit{{ $item->id }}() {
            var map = new google.maps.Map(document.getElementById('map-edit-{{ $item->id }}'), {
                center: {
                    lat: {{ $item->latitude }},
                    lng: {{ $item->longitude }}
                },
                zoom: 12
            });

            var marker = new google.maps.Marker({
                position: {
                    lat: {{ $item->latitude }},
                    lng: {{ $item->longitude }}
                },
                map: map,
                draggable: true
            });

            google.maps.event.addListener(marker, 'dragend', function() {
                var latLng = marker.getPosition();
                document.getElementById('latitude-edit-{{ $item->id }}').value = latLng.lat();
                document.getElementById('longitude-edit-{{ $item->id }}').value = latLng.lng();
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initMapEdit{{ $item->id }}();
        });
    </script>
@endpush
