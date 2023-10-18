<section class="section section-discover" style="margin-bottom: 20px;">
    <div class="section-head">
        <div class="section-line"></div>
        <h3 class="section-title">{{ $title }}</h3>

    </div>
    <div style="margin-bottom:20px; " class="text-center">

        <img src="{{ $desa->foto ? Storage::url($desa->foto) : asset('img/no-image.jpg') }}" alt="Destination"
            style="border-radius: 20px; box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            height:500px; ">
    </div>
    <div class="container">
        <h2 class="text-center">Informasi Desa :</h2><br>
        <p class="mb-3">{{ $desa->keterangan }}</p>
        @if (App\Models\DesaDetail::where('id_desa', $desa->id)->first() != null)
            <hr>
            <h2 class="text-center">Monografi {{ $title }}</h2>
            <table class="table table-bordered" style="width: 100%; border:1px;">
                @foreach (json_decode(App\Models\DesaDetail::where('id_desa', $desa->id)->first()->data) as $detail)
                    <tr>
                        <td style="width:300px;"><strong>{{ $detail->title }}</strong></td>
                        <td>{{ $detail->description }}</td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
</section>
