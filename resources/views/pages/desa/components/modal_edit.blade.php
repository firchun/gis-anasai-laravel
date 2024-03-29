<div class="modal fade" id="edit-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
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
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-control-label" for="foto">Foto Kampung<span
                                        class="small text-danger">*</span></label>
                                <input type="file" class="form-control" name="foto">
                            </div>
                            <div class="form-group ">
                                <label class="form-control-label" for="nama_desa">Nama Kampung<span
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
                        </div>
                        <div class="col-md-8">
                            <div class="my-2">
                                <h4>Monografi Kampung</h4>
                                <hr>
                            </div>
                            @php
                                $desa = App\Models\DesaDetail::where('id_desa', $item->id)->first();
                            @endphp
                            @if ($desa)
                                @foreach (json_decode($desa->data) as $index => $detail)
                                    @if ($detail->title != null && $detail->description != null)
                                        <div class="form-group d-flex my-2"
                                            id="form-container-{{ $item->id }}-{{ $index }}">
                                            <input type="text" name="title[]" value="{{ $detail->title }}"
                                                placeholder="Judul" class="form-control mx-2" style="width: 200px;">
                                            <textarea name="description[]" placeholder="Isi" class="form-control mx-2" rows="1">{{ $detail->description }}</textarea>
                                            <button type="button" class="btn btn-danger remove-button"
                                                data-index="{{ $index }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="form-group my-2"
                                    id="form-container-{{ $item->id }}-{{ $item->id }}">
                                    <div class="d-flex">
                                        <input type="text" name="title[]" placeholder="Judul"
                                            class="form-control mx-2" style="width: 200px;">
                                        <textarea name="description[]" placeholder="Isi" class="form-control mx-2" rows="1"></textarea>
                                        <button type="button" class="btn btn-primary add-button-{{ $item->id }}"
                                            data-id="{{ $item->id }}"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group my-2"
                                id="form-container-{{ $item->id }}-{{ $item->id }}">
                                <div class="d-flex">
                                    <input type="text" name="title[]" placeholder="Judul"
                                        class="form-control mx-2" style="width: 200px;">
                                    <textarea name="description[]" placeholder="Isi" class="form-control mx-2" rows="1"></textarea>
                                    <button type="button" class="btn btn-primary add-button-{{ $item->id }}"
                                        data-id="{{ $item->id }}"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Simpan Perubahan') }}</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@push('js')
    @if ($desa && $desa->data)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @foreach (json_decode($desa->data) as $index => $detail)
                    const formContainer{{ $index }} = document.getElementById(
                        'form-container-{{ $item->id }}-{{ $index }}');
                    const removeButton{{ $index }} = formContainer{{ $index }}.querySelector(
                        '.remove-button');
                    removeButton{{ $index }}.addEventListener('click', () => removeForm(
                        formContainer{{ $index }}));
                @endforeach

                function removeForm(formContainer) {
                    formContainer.remove();
                }
            });
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initMapEdit{{ $item->id }}();

            const formContainer = document.getElementById(
                'form-container-{{ $item->id }}-{{ $item->id }}');

            // function addForm() {
            //     const formGroup = document.createElement('div');
            //     const itemId = "{{ $item->id }}";
            //     formGroup.classList.add('form-group', 'd-flex', 'my-2');
            //     formGroup.innerHTML = `
        //         <input type="text" name="title[]" placeholder="Judul" class="form-control mx-2" style="width: 200px;">
        //         <textarea name="description[]" placeholder="Isi" class="form-control mx-2" rows="1"></textarea>
        //         <button type="button" class="btn btn-danger remove-button" data-id="${itemId}"><i class="fa fa-trash"></i></button>
        //     `;
            //     formContainer.appendChild(formGroup);

            //     const removeButton = formGroup.querySelector('.remove-button');
            //     removeButton.addEventListener('click', () => removeForm(formGroup));
            // }
            function addForm() {
                const formGroup = document.createElement('div');
                const itemId = "{{ $item->id }}";
                formGroup.classList.add('form-group', 'd-flex', 'my-2');
                formGroup.innerHTML = `
                        <input type="text" name="title[]" placeholder="Judul" class="form-control mx-2" style="width: 200px;">
                        <textarea name="description[]" placeholder="Isi" class="form-control mx-2" rows="1"></textarea>
                        <button type="button" class="btn btn-danger remove-button" data-id="${itemId}"><i class="fa fa-trash"></i></button>
                    `;
                formContainer.appendChild(formGroup);

                const removeButton = formGroup.querySelector('.remove-button');
                removeButton.addEventListener('click', () => removeForm(formGroup));

                const formContainer = document.getElementById('form-container-{{ $item->id }}');
                formContainer.appendChild(document.createElement('div'));
            }

            function removeForm(formGroup) {
                formGroup.remove();
            }

            const addButton = document.querySelector('.add-button-{{ $item->id }}');
            addButton.addEventListener('click', addForm);
        });
    </script>
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
