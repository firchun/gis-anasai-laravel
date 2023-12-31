<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kegiatan;
use App\Models\Lapak;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_all_desa()
    {
        $desa = Desa::query();
        $desa = $desa->where('latitude', '!=', NULL)
            ->where('latitude', '!=', '')
            ->where('longitude', '!=', NULL)
            ->where('longitude', '!=', '')
            ->get();

        $desa->each(function ($desa) {
            $desa->foto_url = $desa->foto !== null ? url(Storage::url($desa->foto)) : asset('img/no-image.png');
            $desa->keterangan = $desa->keterangan !== null ? $desa->keterangan : 'Keterangan tidak tersedia';
            $desa->detail_url = url('village/detail', $desa->slug);
        });
        return response()->json($desa);
    }
    public function get_all_kegiatan()
    {
        $kegiatan = Kegiatan::query();
        $kegiatan = $kegiatan->where('latitude', '!=', NULL)
            ->where('latitude', '!=', '')
            ->where('longitude', '!=', NULL)
            ->where('longitude', '!=', '')
            ->get();
        $kegiatan->each(function ($kegiatan) {
            $kegiatan->foto_url = $kegiatan->foto !== null ?  url(Storage::url($kegiatan->foto)) : asset('img/no-image.png');
            $kegiatan->detail_url = url('event/detail', $kegiatan->slug);
        });
        return response()->json($kegiatan);
    }
    public function get_all_lapak()
    {
        $lapak = Lapak::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('latitude', '<>', '')
            ->where('longitude', '<>', '')
            ->with('produk')
            ->get();

        $lapak->each(function ($lapak) {
            $lapak->foto_url = $lapak->foto !== null ?  url(Storage::url($lapak->foto)) : asset('img/no-image.png');
            $lapak->detail_url = url('shop/detail', $lapak->slug);
        });

        $produkList = [];

        foreach ($lapak as $item) {
            foreach ($item->produk as $produk) {
                $produkList[] = $produk->nama_produk;
            }
        }

        return response()->json([
            'lapak' => $lapak
        ]);
    }

    public function get_all_wisata()
    {
        $Wisata = Wisata::query();
        $Wisata = $Wisata->where('latitude', '!=', NULL)
            ->where('latitude', '!=', '')
            ->where('longitude', '!=', NULL)
            ->where('longitude', '!=', '')
            ->get();
        $Wisata->each(function ($Wisata) {
            $Wisata->foto_url = $Wisata->foto !== null ?  url(Storage::url($Wisata->foto)) : asset('img/no-image.png');
            $Wisata->harga = 'Rp ' . number_format($Wisata->harga);
            $Wisata->detail_url = url('tour/detail', $Wisata->slug);
        });
        return response()->json($Wisata);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
