<!-- ulasan Modal-->
@foreach (App\Models\Wisata::all() as $item)
    <div class="modal fade" id="ulasan-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Ulasan') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Rating</th>
                                    <th>Ulasan</th>
                                    <th>Oleh</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\reviewRating::where('identity', $item->id)->where('type', 'lapak')->get() as $rating)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @for ($i = 1; $i <= $rating->star_rating; $i++)
                                                <i class="fa fa-star text-warning "></i>
                                            @endfor
                                        </td>
                                        <td>{{ $rating->comments }}</td>
                                        <td>{{ $rating->user->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
