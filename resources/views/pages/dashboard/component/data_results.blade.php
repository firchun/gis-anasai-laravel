@if ($data->count() != 0)
    <div class="card py-2" style="border-radius: 10px;">
        <table class="table table-borderless table-hover ">
            @foreach ($data as $item)
                <tr>
                    <td>
                        <a href="{{ url(Storage::url($item->file)) }}" target="_blank"
                            class="text-link"><strong>{{ $item->nama_file }}</strong></a><br>
                        <small><u class="text-primary">{{ $item->jenis->jenis_file }}</u>
                            <span class="text-muted"> | Diupload {{ $item->created_at->diffForHumans() }}</span></small>
                    </td>
                    <td style="width: 150px;" class="text-left">
                        <a href="{{ url(Storage::url($item->file)) }}" target="_blank" class="btn btn-success">Open <i
                                class="fa fa-arrow-right"></i></a>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="pagination justify-content-center mt-2">
            {{ $data->links() }}
        </div>
    </div>
@endif
