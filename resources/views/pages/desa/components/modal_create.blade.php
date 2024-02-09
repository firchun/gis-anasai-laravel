<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Tambah Data') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('desa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="my-2">
                                <h4>Informasi Kampung</h4>
                                <hr>
                            </div>
                            <div class="form-group ">
                                <label class="form-control-label" for="foto">Foto Kampung<span
                                        class="small text-danger">*</span></label>
                                <input type="file" class="form-control" name="foto">
                            </div>
                            <div class="form-group ">
                                <label class="form-control-label" for="nama_desa">Nama Kampung<span
                                        class="small text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_desa" placeholder="Nama Kampung">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group ">
                                        <label class="form-control-label" for="jumlah_kk">Jumlah KK<span
                                                class="small text-danger">*</span></label>
                                        <input type="number" class="form-control" name="jumlah_kk" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group ">
                                        <label class="form-control-label" for="jumlah_jiwa">Jumlah Jiwa<span
                                                class="small text-danger">*</span></label>
                                        <input type="number" class="form-control" name="jumlah_jiwa" placeholder="0">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="form-control-label" for="keterangan">Keterangan Tambahan<span
                                        class="small text-danger">*</span></label>
                                <textarea name="keterangan" class="form-control"></textarea>
                            </div>
                            <small class="text-danger">Geser pin untuk memberikan menyesuikan koordinat</small><br>
                            <div id="map-create" style="height: 300px;"></div>
                            <input type="hidden" name="latitude" id="latitude-create" required>
                            <input type="hidden" name="longitude" id="longitude-create" required>
                        </div>
                        <div class="col-md-8">
                            <div class="my-2">
                                <h4>Monografi Kampung</h4>
                                <hr>
                            </div>
                            <div class="form-group my-2" id="form-container">
                                <div class="d-flex">
                                    <input type="text" name="title[]" placeholder="Judul" class="form-control mx-2"
                                        style="width: 200px;">
                                    <textarea name="description[]" placeholder="Isi" class="form-control mx-2" rows="1"></textarea>
                                    <button type="button" class="btn btn-primary add-button"><i
                                            class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formContainer = document.getElementById('form-container');

            function addForm() {
                const formGroup = document.createElement('div');
                formGroup.classList.add('form-group', 'd-flex', 'my-2');
                formGroup.innerHTML = `
                <input type="text" name="title[]" placeholder="Judul" class="form-control mx-2" style="width: 200px;">
               
                <textarea name="description[]" placeholder="Isi" class="form-control mx-2" rows="1"></textarea>
                <button type="button" class="btn btn-danger remove-button"><i class="fa fa-trash"></i></button>
            `;
                formContainer.appendChild(formGroup);

                const removeButton = formGroup.querySelector('.remove-button');
                removeButton.addEventListener('click', () => removeForm(formGroup));
            }

            function removeForm(formGroup) {
                formGroup.remove();
            }

            const addButtons = document.querySelectorAll('.add-button');
            addButtons.forEach(button => {
                button.addEventListener('click', addForm);
            });
        });
    </script>
    {{-- maps --}}
    <script>
        var mapCreate;
        var markerCreate;

        function initMapCreate() {
            mapCreate = new google.maps.Map(document.getElementById('map-create'), {
                center: {
                    lat: -8.4558282,
                    lng: 140.300181
                },
                zoom: 12
            });

            markerCreate = new google.maps.Marker({
                map: mapCreate,
                draggable: true,
                position: {
                    lat: -8.4558282,
                    lng: 140.300181
                }
            });

            google.maps.event.addListener(markerCreate, 'dragend', function() {
                var latLng = markerCreate.getPosition();
                document.getElementById('latitude-create').value = latLng.lat();
                document.getElementById('longitude-create').value = latLng.lng();
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initMapCreate();
        });
    </script>
@endpush
