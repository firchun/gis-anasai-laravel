<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Data Event {{ date('d-m-Y') }}</title>
    <meta http-equiv="Content-Type" content="charset=utf-8" />
    <link rel="stylesheet" href="{{ public_path('css') }}/pdf/bootstrap.min.css" media="all" />
    <style>
        body {
            font-family: 'times new roman';
            font-size: 12px;
        }
    </style>
    <link href="{{ public_path('img/favicon.png') }}" rel="icon" type="image/png">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"> --}}
</head>

<body>
    <main>
        <table class="table table-borderless" style="font-size: 14px;">
            <tr>
                <td style="width: 20%">
                    {{-- <img style="width: 100px;" src="{{ public_path('img') }}/favicon.png"> --}}
                </td>
                <td class="text-center" style="width: 80%">
                    <h1> WISATA ANASAI</h1>
                    <b>Laporan Data Event
                    </b>
                </td>
                <td style="width: 20%"></td>
            </tr>
        </table>
        <hr>
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
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="width: 150px;" class="text-center"><img
                                src="{{ public_path($item->foto ? Storage::url($item->foto) : asset('img/no-image.jpg')) }}"
                                class="img-fluid rounded" style="height: 80px;"></td>
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
    </main>

</body>

</html>
