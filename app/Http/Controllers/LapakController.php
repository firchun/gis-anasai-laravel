<?php

namespace App\Http\Controllers;

use App\Models\Lapak;
use App\Models\ProdukLapak;
use App\Models\ProdukStok;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LapakController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Master Data Lapak ',
            'lapak' => Auth::user()->role != 'seller' ? Lapak::all() : Lapak::where('id_user', Auth::user()->id)->get(),
        ];
        return view('pages.lapak.index', $data);
    }
    public function produk_lapak($id)
    {
        $data = [
            'title' => 'Merchandise/produk Lapak',
            'lapak' => Lapak::findOrFail($id),
            'produk_lapak' => ProdukLapak::where('id_lapak', $id)->get(),
        ];
        return view('pages.lapak.produk.index', $data);
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_lapak' => ['required'],
                'id_user' => ['required'],
                'latitude' => ['required'],
                'longitude' => ['required'],
                'foto' => ['nullable', 'mimes:jpeg,png,jpg,gif'],
            ]);
            $lapak = new Lapak();
            if ($request->hasFile('foto')) {
                $filename = Str::random(32) . '.' . $request->file('foto')->getClientOriginalExtension();
                $file_path = $request->file('foto')->storeAs('public/fotos', $filename);
            }
            $lapak->foto = isset($file_path) ? $file_path : '';
            $lapak->nama_lapak = $request->nama_lapak;
            $lapak->slug =  Str::slug($request->nama_lapak);
            $lapak->id_user = $request->id_user;
            $lapak->latitude = $request->latitude;
            $lapak->longitude = $request->longitude;

            if ($lapak->save()) {
                return redirect()->back()->with('success', 'Berhasil menambahkan desa');
            } else {
                return redirect()->back()->with('danger', 'Gagal menambahkan desa');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan : ' . $e->getMessage());
        }
    }
    public function store_produk(Request $request)
    {
        try {
            $request->validate([
                'nama_produk' => ['required'],
                'id_lapak' => ['required'],
                'harga' => ['required'],
                'foto' => ['nullable', 'mimes:jpeg,png,jpg,gif'],
            ]);
            $produk = new ProdukLapak();
            if ($request->hasFile('foto')) {
                $filename = Str::random(32) . '.' . $request->file('foto')->getClientOriginalExtension();
                $file_path = $request->file('foto')->storeAs('public/fotos', $filename);
            }
            $produk->foto = isset($file_path) ? $file_path : '';
            $produk->slug =  Str::slug($request->nama_produk);
            $produk->nama_produk = $request->nama_produk;
            $produk->id_lapak = $request->id_lapak;
            $produk->harga = $request->harga;
            $produk->keterangan = $request->keterangan;

            if ($produk->save()) {
                return redirect()->back()->with('success', 'Berhasil menambahkan produk');
            } else {
                return redirect()->back()->with('danger', 'Gagal menambahkan produk');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan : ' . $e->getMessage());
        }
    }
    public function store_stok(Request $request)
    {
        try {
            $request->validate([
                'id_produk_lapak' => ['required'],
                'jumlah' => ['required'],
                'jenis' => ['required'],
            ]);

            $stok = new ProdukStok();
            $stok->id_produk_lapak = $request->id_produk_lapak;
            $stok->jumlah = $request->jumlah;
            $stok->jenis = $request->jenis;

            $cek_stok = ProdukStok::getTotalStokProduk($request->id_produk_lapak);
            // dd($cek_stok);
            if ($request->jenis == 'pengeluaran' && $request->jumlah >= $cek_stok) {
                return redirect()->back()->with('danger', 'Gagal mengurangi stok, jumlah stok yang tersedia tidak mencukupi..');
            } else {
                if ($stok->save()) {
                    return redirect()->back()->with('success', 'Berhasil udpate stok');
                } else {
                    return redirect()->back()->with('danger', 'Gagal udpate stok');
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan : ' . $e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        try {
            $request->validate([
                'nama_lapak' => ['required'],
                'latitude' => ['required'],
                'longitude' => ['required'],
                'foto' => ['nullable', 'mimes:jpeg,png,jpg,gif'],
            ]);
            $lapak = Lapak::findOrFail($id);
            if ($request->hasFile('foto')) {
                if ($lapak->foto != '') {
                    Storage::delete($lapak->foto);
                }

                $filename = Str::random(32) . '.' . $request->file('foto')->getClientOriginalExtension();
                $file_path = $request->file('foto')->storeAs('public/fotos', $filename);
            }
            $lapak->foto = isset($file_path) ? $file_path : $lapak->foto;
            $lapak->id_user = $request->id_user;
            $lapak->slug =  Str::slug($request->nama_lapak);
            $lapak->nama_lapak = $request->nama_lapak;
            $lapak->latitude = $request->latitude;
            $lapak->longitude = $request->longitude;

            if ($lapak->save()) {
                return redirect()->back()->with('success', 'Berhasil mengubah data desa');
            } else {
                return redirect()->back()->with('danger', 'Gagal mengubah data desa');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan : ' . $e->getMessage());
        }
    }
    public function update_produk(Request $request,  $id)
    {
        try {
            $request->validate([
                'nama_produk' => ['required'],
                'harga' => ['required'],
                'foto' => ['nullable', 'mimes:jpeg,png,jpg,gif'],
            ]);
            $produk = ProdukLapak::findOrFail($id);
            if ($request->hasFile('foto')) {
                if ($produk->foto != '') {
                    Storage::delete($produk->foto);
                }

                $filename = Str::random(32) . '.' . $request->file('foto')->getClientOriginalExtension();
                $file_path = $request->file('foto')->storeAs('public/fotos', $filename);
            }
            $produk->foto = isset($file_path) ? $file_path : $produk->foto;
            $produk->slug =  Str::slug($request->nama_produk);
            $produk->nama_produk = $request->nama_produk;
            $produk->harga = $request->harga;
            $produk->keterangan = $request->keterangan;

            if ($produk->save()) {
                return redirect()->back()->with('success', 'Berhasil mengubah data produk');
            } else {
                return redirect()->back()->with('danger', 'Gagal mengubah data produk');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $lapak = Lapak::findOrFail($id);
            if ($lapak->foto != '') {
                Storage::delete($lapak->foto);
            }
            $produk = ProdukLapak::where('id_lapak', $id);
            if ($produk) {
                $produk->delete();
            }
            $lapak->delete();
            return back()->with(['success' => 'Berhasil menghapus data']);
        } catch (QueryException $e) {
            return back()->with(['danger' => 'Tidak dapat menghapus data karena ada keterkaitan data lain.']);
        } catch (\Exception $e) {
            return back()->with(['danger' => 'Terjadi kesalahan saat menghapus data.']);
        }
    }
    public function destroy_produk($id)
    {

        try {
            $produk = ProdukLapak::findOrFail($id);
            if ($produk->foto != '') {
                Storage::delete($produk->foto);
            }
            $check_stok = ProdukStok::where('id_produk_lapak', $id);
            if ($check_stok) {
                $check_stok->delete();
            }
            $produk->delete();
            return back()->with(['success' => 'Berhasil menghapus data']);
        } catch (QueryException $e) {
            return back()->with(['danger' => 'Tidak dapat menghapus data karena ada keterkaitan data lain.']);
        } catch (\Exception $e) {
            return back()->with(['danger' => 'Terjadi kesalahan saat menghapus data.']);
        }
    }
}
