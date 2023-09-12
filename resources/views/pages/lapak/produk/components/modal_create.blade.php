<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Tambah Data') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('lapak.produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <input type="hidden" name="id_lapak" value="{{ $lapak->id }}">
                        <label class="form-control-label" for="foto">Foto Produk<span
                                class="small text-danger">*</span></label>
                        <input type="file" class="form-control" name="foto">
                    </div>
                    <div class="form-group ">
                        <label class="form-control-label" for="nama_produk">Nama Produk<span
                                class="small text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_produk" placeholder="Nama Produk">
                    </div>
                    <div class="form-group ">
                        <label class="form-control-label" for="harga">Harga Produk<span
                                class="small text-danger">*</span></label>
                        <input type="number" class="form-control" name="harga" placeholder="0">
                    </div>
                    <div class="form-group ">
                        <label class="form-control-label" for="keterangan">Keterangan Produk<span
                                class="small text-danger">*</span></label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
