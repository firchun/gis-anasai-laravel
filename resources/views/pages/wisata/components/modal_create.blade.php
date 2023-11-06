<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Tambah Data') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('wisata.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group ">
                                <label class="form-control-label" for="foto">Foto Wisata<span
                                        class="small text-danger">*</span></label>
                                <input type="file" class="form-control" name="foto">
                            </div>
                            <div class="form-group ">
                                <label class="form-control-label" for="nama_wisata">Nama Wisata<span
                                        class="small text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_wisata" placeholder="Nama Wisata">
                            </div>
                            <div class="form-group ">
                                <label class="form-control-label" for="harga">Harga Wisata<span
                                        class="small text-danger">*</span></label>
                                <input type="number" class="form-control" name="harga">
                            </div>

                            <div class="form-group ">
                                <label class="form-control-label" for="keterangan">Keterangan Tambahan<span
                                        class="small text-danger">*</span></label>
                                <textarea name="keterangan" class="form-control"></textarea>
                            </div>
                            <div id="map-create" style="height: 300px;"></div>
                            <input type="hidden" name="latitude" id="latitude-create">
                            <input type="hidden" name="longitude" id="longitude-create">
                        </div>
                        <div class="col-lg-8">
                            <div class="my-2">
                                <h4>Tambahkan Foto wisata</h4>
                                <hr>
                            </div>
                            <div class="form-group my-2" id="form-container">
                                <div class="d-flex">
                                    <input type="text" name="title[]" placeholder="Judul" class="form-control mx-2"
                                        style="width: 200px;">
                                    <input type="file" name="foto_wisata[]" class="form-control mx-2"
                                        style="width: 200px;">
                                    <textarea name="description[]" placeholder="Keterangan" class="form-control mx-2" rows="1"></textarea>
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
                <input type="file" name="foto_wisata[]"  class="form-control mx-2" style="width: 200px;">
               
                <textarea name="description[]" placeholder="Keterangan" class="form-control mx-2" rows="1"></textarea>
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
