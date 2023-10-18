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
            'title' => '- Homepage',
            'kegiatan' => Kegiatan::latest()->limit(4)->get(),
            'produk_lapak' => ProdukLapak::latest()->limit(4)->get(),
            'wisata' => Wisata::latest()->limit(4)->get(),
            'desa' => Desa::latest()->limit(4)->get(),
        ];
        return view('pages.landing_page.index', $data);
    }
    public function desa()
    {
        $data = [
            'title' => '- Desa Pada Anasai',
            'desa' => Desa::all(),
        ];
        return view('pages.landing_page.desa', $data);
    }
    public function desa_detail($id)
    {
        $desa = Desa::findOrFail($id);
        $data = [
            'title' => 'Desa : ' . $desa->nama_desa,
            'desa' => $desa,
        ];
        return view('pages.landing_page.desa_detail', $data);
    }
    public function event()
    {
        $data = [
            'title' => '- Event Pada Anasai',
            'kegiatan' => Kegiatan::latest()->paginate(10),
        ];
        return view('pages.landing_page.event', $data);
    }
    public function event_detail($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $data = [
            'title' => 'Event : ' . $kegiatan->nama_kegiatan,
            'kegiatan' => $kegiatan,
        ];
        return view('pages.landing_page.event_detail', $data);
    }
    public function wisata()
    {
        $data = [
            'title' => '- wisata Pada Anasai',
            'wisata' => Wisata::latest()->paginate(10),
        ];
        return view('pages.landing_page.wisata', $data);
    }
    public function wisata_detail($id)
    {
        $wisata = Wisata::findOrFail($id);
        $data = [
            'title' => 'wisata : ' . $wisata->nama_wisata,
            'wisata' => $wisata,
        ];
        return view('pages.landing_page.wisata_detail', $data);
    }
    public function merchandise()
    {
        $data = [
            'title' => '- Merchandise',
            'produk_lapak' => ProdukLapak::latest()->paginate(20),
        ];
        return view('pages.landing_page.merchandise', $data);
    }
    public function merchandise_detail($id)
    {
        $produk_lapak = ProdukLapak::findOrFail($id);
        $data = [
            'title' => 'Merchandise : ' . $produk_lapak->nama_produk,
            'produk_lapak' => $produk_lapak,
        ];
        return view('pages.landing_page.merchandise_detail', $data);
    }
    public function shop()
    {
        $data = [
            'title' => '- shop',
            'toko' => Lapak::latest()->paginate(20),
        ];
        return view('pages.landing_page.shop', $data);
    }
    public function shop_detail($id)
    {
        $toko = Lapak::findOrFail($id);
        $produk_toko = ProdukLapak::where('id_lapak', $id)->get();
        $data = [
            'title' => 'Toko : ' . $toko->nama_lapak,
            'toko' => $toko,
            'produk_toko' => $produk_toko,
        ];
        return view('pages.landing_page.shop_detail', $data);
    }
}
