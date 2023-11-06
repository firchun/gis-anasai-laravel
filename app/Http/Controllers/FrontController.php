<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kegiatan;
use App\Models\Lapak;
use App\Models\ProdukLapak;
use App\Models\ProdukStok;
use App\Models\Wisata;
use GuzzleHttp\RetryMiddleware;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class FrontController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Homepage',
            'kegiatan' => Kegiatan::latest()->limit(3)->get(),
            'lapak' => Lapak::latest()->limit(3)->get(),
            'wisata' => Wisata::latest()->limit(3)->get(),
            'desa' => Desa::latest()->limit(3)->get(),
        ];
        return view('pages.landing_page.index', $data);
    }
    public function desa()
    {
        $data = [
            'title' => 'Desa Pada Sinai',
            'desa' => Desa::latest()->paginate(20),
        ];
        return view('pages.landing_page.desa', $data);
    }
    public function desa_detail($slug)
    {
        $desa = Desa::where('slug', $slug)->firstOrFail();
        $data = [
            'title' => 'Desa : ' . $desa->nama_desa,
            'desa' => $desa,
        ];
        return view('pages.landing_page.desa_detail', $data);
    }
    public function event()
    {
        $data = [
            'title' => 'Event Pada Sinai',
            'kegiatan' => Kegiatan::latest()->paginate(10),
        ];
        return view('pages.landing_page.event', $data);
    }
    public function event_detail($slug)
    {
        $kegiatan = Kegiatan::where('slug', $slug)->firstOrFail();
        $data = [
            'title' => 'Event : ' . $kegiatan->nama_kegiatan,
            'kegiatan' => $kegiatan,
        ];
        return view('pages.landing_page.event_detail', $data);
    }
    public function wisata()
    {
        $data = [
            'title' => 'wisata Pada Sinai',
            'wisata' => Wisata::latest()->paginate(10),
        ];
        return view('pages.landing_page.wisata', $data);
    }
    public function wisata_detail($slug)
    {
        $wisata = Wisata::where('slug', $slug)->firstOrFail();
        $data = [
            'title' => 'wisata : ' . $wisata->nama_wisata,
            'wisata' => $wisata,
        ];
        return view('pages.landing_page.wisata_detail', $data);
    }
    public function merchandise()
    {
        $data = [
            'title' => 'Produk',
            'produk_lapak' => ProdukLapak::latest()->paginate(20),
        ];
        return view('pages.landing_page.merchandise', $data);
    }
    public function merchandise_detail($slug)
    {
        $produk_lapak = ProdukLapak::where('slug', $slug)->firstOrFail();
        $data = [
            'title' => 'Produk : ' . $produk_lapak->nama_produk,
            'produk_lapak' => $produk_lapak,
        ];
        return view('pages.landing_page.merchandise_detail', $data);
    }
    public function shop()
    {
        $data = [
            'title' => 'Lapak',
            'lapak' => Lapak::latest()->paginate(20),
        ];
        return view('pages.landing_page.shop', $data);
    }
    public function shop_detail($slug)
    {
        $toko = Lapak::where('slug', $slug)->firstOrFail();
        $produk_toko = ProdukLapak::where('id_lapak', $toko->id)->get();
        $data = [
            'title' => 'Lapak : ' . $toko->nama_lapak,
            'toko' => $toko,
            'produk_toko' => $produk_toko,
        ];
        return view('pages.landing_page.shop_detail', $data);
    }
    public function search(Request $request)
    {
        $keywords = $request->keywords;

        $wisata = Wisata::where('nama_wisata', 'LIKE', '%' . $keywords . '%')->paginate(10);
        $kegiatan = Kegiatan::where('nama_kegiatan', 'LIKE', '%' . $keywords . '%')->paginate(10);
        $data = [
            'title' => 'Hasil pencarian',
            'wisata' => $wisata,
            'kegiatan' => $kegiatan,
        ];
        return view('pages.landing_page.search', $data)->with('keywords', $keywords);
    }
}
