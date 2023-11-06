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
                <a href="{{ route('laporan.exportKegiatan') }}" class="btn btn-primary"><i class="fa fa-download"></i>
                    Export
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
                                <th>Nama Event</th>
                                <th>keterangan Event</th>
                                <th>Koorinat Event</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kegiatan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="width: 150px;" class="text-center"><img
                                            src="{{ $item->foto ? Storage::url($item->foto) : asset('img/no-image.jpg') }}"
                                            class="img-fluid rounded" style="height: 80px;" loading="lazy"></td>
                                    <td><strong>Event
                                            {{ $item->nama_kegiatan }}</strong><br>Mulai tanggal
                                        {{ $item->tanggal_mulai . ' sampai dengan ' . $item->tanggal_selesai }}
                                    </td>
                                    <td>
                                        {!! $item->keterangan
                                            ? Str::limit($item->keterangan, 200)
                                            : '<span class="text-muted">Keterangan tidak tersedia</span>' !!}
                                    </td>
                                    <td>{!! 'Latitude : ' . $item->latitude . '<br> Longitude : ' . $item->longitude !!}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
