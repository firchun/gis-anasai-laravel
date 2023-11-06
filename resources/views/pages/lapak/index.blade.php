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
                    Tambah Lapak
                </a>
            </div>

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>Nama Lapak</th>
                                    <th>Pemilik Lapak</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lapak as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="width: 150px;" class="text-center"><img
                                                src="{{ $item->foto ? Storage::url($item->foto) : asset('img/no-image.jpg') }}"
                                                class="img-fluid rounded" style="height: 80px;" loading="lazy"></td>
                                        <td><strong>Lapak
                                                {{ $item->nama_lapak }}</strong><br>
                                            @php
                                                $rating = App\Models\reviewRating::where('identity', $item->id)->where('type', 'lapak');
                                                $review = $rating->count();
                                                $average_rating = $rating->avg('star_rating');
                                                $total_rating = round($average_rating);
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
                                        <td>
                                            <strong>{{ $item->user->name }}</strong><br>
                                            <a class="text-muted" href="mailto:{{ $item->user->email }}"><i
                                                    class="fa fa-envelope"></i> {{ $item->user->email }}</a><br>
                                            <a class="text-success" target="__blank"
                                                href="https://wa.me/{{ $item->user->phone }}"><i class="fa fa-phone"></i>
                                                {{ $item->user->phone }}</a><br>
                                        </td>

                                        <td style="width: 250px;">
                                            <a href="#" data-toggle="modal" data-target="#ulasan-{{ $item->id }}"
                                                class="btn btn-info position-relative"><i class="fa fa-comments"></i>
                                                <span
                                                    class="badge badge-danger position-absolute top-0 end-0">{{ $review }}</span>
                                            </a>
                                            <a href="{{ route('lapak.produk', $item->id) }}" class="btn btn-primary "><i
                                                    class="fa fa-eye"></i> Produk
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#edit-{{ $item->id }}"
                                                class="btn btn-warning"><i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#delete-{{ $item->id }}"
                                                class="btn btn-danger"><i class="fa fa-trash"></i>
                                            </a>
                                            @include('pages.lapak.components.modal_edit')
                                        </td>
                                    </tr>
                                    @include('pages.lapak.components.modal_delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($lapak as $item)
        @include('pages.lapak.components.modal_ulasan')
    @endforeach
    @include('pages.lapak.components.modal_create')
@endsection
@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?&key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&libraries=places">
    </script>
@endpush
