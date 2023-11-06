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
    @if (session('danger'))
        <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
            {{ session('danger') }}
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
            <div class="form-inline my-2">
                <a href="{{ route('lapak') }}" class="btn btn-secondary mx-2"><i class="fa fa-arrow-left"></i>
                    Kembali
                </a>
                <a href="#" data-toggle="modal" data-target="#create" class="btn btn-primary"><i
                        class="fa fa-plus"></i>
                    Tambah Produk
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="2" class="text-center">
                                <img src="{{ $lapak->foto ? Storage::url($lapak->foto) : asset('img/no-image.jpg') }}"
                                    class="img-fluid rounded" style="height: 150px;">
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Lapak</td>
                            <td>{{ $lapak->nama_lapak }}</td>
                        </tr>
                        <tr>
                            <td>Pemilik Lapak</td>
                            <td>{{ $lapak->user->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
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
                                <th>Nama Produk</th>
                                <th>Harga Produk</th>
                                <th>Keterangan</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk_lapak as $item)
                                @php
                                    $jumlah_stok = App\Models\ProdukStok::getTotalStokProduk($item->id);
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="width: 150px;" class="text-center"><img
                                            src="{{ $item->foto ? Storage::url($item->foto) : asset('img/no-image.jpg') }}"
                                            class="img-fluid rounded" style="height: 80px;"></td>
                                    <td><strong>
                                            {{ $item->nama_produk }}</strong><br>
                                        {!! $jumlah_stok != 0
                                            ? '<strong class="text-primary"> Tersedia : ' . $jumlah_stok . '</strong>'
                                            : '<strong class="text-danger"> Stok tidak tersedia</strong>' !!}
                                    </td>
                                    <td>Rp {{ number_format($item->harga) }}</td>
                                    <td>
                                        {{ $item->keterangan }}
                                    </td>

                                    <td style="width: 100px;">
                                        <a href="#" data-toggle="modal" data-target="#stok-add-{{ $item->id }}"
                                            class="btn btn-warning"><i class="fa fa-plus"></i>
                                        </a>
                                        <a href="#" data-toggle="modal"
                                            data-target="#stok-delete-{{ $item->id }}" class="btn btn-danger"><i
                                                class="fa fa-minus"></i>
                                        </a>
                                        @include('pages.lapak.produk.components.modal_stok_add')
                                    </td>
                                    <td style="width: 200px;">

                                        <a href="#" data-toggle="modal" data-target="#edit-{{ $item->id }}"
                                            class="btn btn-warning"><i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#delete-{{ $item->id }}"
                                            class="btn btn-danger"><i class="fa fa-trash"></i>
                                        </a>
                                        @include('pages.lapak.produk.components.modal_edit')
                                    </td>
                                    @include('pages.lapak.produk.components.modal_stok_delete')
                                </tr>
                                @include('pages.lapak.produk.components.modal_delete')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('pages.lapak.produk.components.modal_create')
@endsection
