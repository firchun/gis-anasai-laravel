@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

        <div class="col-lg-12 ">
            <div class="my-2">
                <a href="#" data-toggle="modal" data-target="#create" class="btn btn-primary"><i
                        class="fa fa-plus"></i>
                    Tambah Wisata
                </a>
            </div>

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                </div>

                <div class="card-body">
                    <table id="dataTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama Wisata</th>
                                <th>Harga </th>
                                <th>keterangan Wisata</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wisata as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="width: 150px;" class="text-center"><img
                                            src="{{ $item->foto ? Storage::url($item->foto) : asset('img/no-image.jpg') }}"
                                            class="img-fluid rounded" style="height: 80px;" loading="lazy"></td>
                                    <td><strong>Wisata
                                            {{ $item->nama_wisata }}</strong><br>
                                        @php
                                            $rating = App\Models\reviewRating::where('identity', $item->id)->where('type', 'wisata');
                                            $review = $rating->count();
                                            $average_rating = $rating->avg('star_rating');
                                            $total_rating = round($average_rating);

                                            $images = App\Models\WisataFoto::where('id_wisata', $item->id)->count();
                                        @endphp
                                        @if ($total_rating != 0)
                                            @for ($i = 1; $i <= $total_rating; $i++)
                                                <i class="fa fa-star text-warning "></i>
                                            @endfor
                                        @else
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fa fa-star text-muted "></i>
                                            @endfor
                                        @endif
                                    </td>
                                    <td><strong>Rp
                                            {{ number_format($item->harga) }}</strong>
                                    </td>
                                    <td>
                                        {!! $item->keterangan
                                            ? Str::limit($item->keterangan, 200)
                                            : '<span class="text-muted">Keterangan tidak tersedia</span>' !!}
                                    </td>

                                    <td style="width: 250px;">
                                        <a href="#" data-toggle="modal" data-target="#ulasan-{{ $item->id }}"
                                            class="btn btn-info position-relative"><i class="fa fa-comments"></i>
                                            <span
                                                class="badge badge-danger position-absolute top-0 end-0">{{ $review }}</span>
                                        </a>
                                        <a href="{{ route('wisata.images', $item->id) }}"
                                            class="btn btn-primary position-relative"><i class="fa fa-images"></i>
                                            <span
                                                class="badge badge-danger position-absolute top-0 end-0">{{ $images }}</span>
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#edit-{{ $item->id }}"
                                            class="btn btn-warning "><i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#delete-{{ $item->id }}"
                                            class="btn btn-danger"><i class="fa fa-trash"></i> Hapus
                                        </a>

                                        @include('pages.wisata.components.modal_edit')
                                    </td>
                                </tr>
                                @include('pages.wisata.components.modal_delete')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($wisata as $item)
        @include('pages.wisata.components.modal_ulasan')
    @endforeach
    @include('pages.wisata.components.modal_create')
@endsection
@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?&key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&libraries=places">
    </script>
@endpush
