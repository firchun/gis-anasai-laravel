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
                <a href="{{ route('wisata') }}" class="btn btn-secondary mx-2"><i class="fa fa-arrow-left"></i>
                    Kembali
                </a>
                <a href="#" data-toggle="modal" data-target="#create" class="btn btn-primary"><i
                        class="fa fa-plus"></i>
                    Tambah Gambar
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
                                <th>Title</th>
                                <th>keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($images as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="width: 150px;" class="text-center"><img
                                            src="{{ $item->foto ? Storage::url($item->foto) : asset('img/no-image.jpg') }}"
                                            class="img-fluid rounded" style="height: 80px;"></td>
                                    <td><strong>
                                            {{ $item->title }}</strong><br>

                                    </td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#edit-{{ $item->id }}"
                                            class="btn btn-warning "><i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#delete-{{ $item->id }}"
                                            class="btn btn-danger"><i class="fa fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                    @include('pages.wisata.components.modal_edit_images')
                                </tr>
                                @include('pages.wisata.components.modal_delete_images')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('pages.wisata.components.modal_create_images')
@endsection
@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?&key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&libraries=places">
    </script>
@endpush
