<div class="modal fade" id="stok-add-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Pemasukkan') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="{{ route('lapak.produk.store_stok') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="jenis" value="pemasukkan">
                    <input type="hidden" name="id_produk_lapak" value="{{ $item->id }}">
                    <div class="form-group ">
                        <label class="form-control-label" for="jumlah">Jumlah<span
                                class="small text-danger">*</span></label>
                        <input type="number" class="form-control" name="jumlah" placeholder="Jumlah"
                            value="{{ $item->jumlah }}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                    </div>
            </form>
        </div>
    </div>
</div>