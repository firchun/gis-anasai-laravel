<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Tambah Gambar') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('wisata.storeFoto') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group my-2" id="form-container">
                        <div class="d-flex">
                            <input type="hidden" name="id_wisata[]" value="{{ $wisata->id }}">
                            <input type="text" name="title[]" placeholder="Judul" class="form-control mx-2"
                                style="width: 200px;">
                            <input type="file" name="foto_wisata[]" class="form-control mx-2" style="width: 350px;">
                            <textarea name="description[]" placeholder="Keterangan" class="form-control mx-2" rows="1"></textarea>
                            <button type="button" class="btn btn-primary add-button"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
            <input type="hidden" name="id_wisata[]" value="<?php echo $wisata->id; ?>">
            <input type="text" name="title[]" placeholder="Judul" class="form-control mx-2" style="width: 200px;">
            <input type="file" name="foto_wisata[]" class="form-control mx-2" style="width: 350px;">
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
@endpush
