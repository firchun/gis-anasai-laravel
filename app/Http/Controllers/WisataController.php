<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WisataController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Master Data Wisata',
            'wisata' => Wisata::all(),
        ];
        return view('pages.wisata.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_wisata' => ['required'],
            'harga' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'foto' => ['nullable', 'mimes:jpeg,png,jpg,gif'],
        ]);
        $wisata = new Wisata();
        if ($request->hasFile('foto')) {
            $filename = Str::random(32) . '.' . $request->file('foto')->getClientOriginalExtension();
            $file_path = $request->file('foto')->storeAs('public/fotos', $filename);
        }
        $wisata->foto = isset($file_path) ? $file_path : '';
        $wisata->nama_wisata = $request->nama_wisata;
        $wisata->harga = $request->harga;
        $wisata->latitude = $request->latitude;
        $wisata->longitude = $request->longitude;
        $wisata->keterangan = $request->keterangan;

        if ($wisata->save()) {
            return redirect()->back()->with('success', 'Berhasil menambahkan desa');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan desa');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wisata  $agama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {

        $request->validate([
            'nama_wisata' => ['required'],
            'harga' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'foto' => ['nullable', 'mimes:jpeg,png,jpg,gif'],
        ]);
        $wisata = Wisata::findOrFail($id);
        if ($request->hasFile('foto')) {
            if ($wisata->foto != '') {
                Storage::delete($wisata->foto);
            }

            $filename = Str::random(32) . '.' . $request->file('foto')->getClientOriginalExtension();
            $file_path = $request->file('foto')->storeAs('public/fotos', $filename);
        }
        $wisata->foto = isset($file_path) ? $file_path : $wisata->foto;
        $wisata->nama_wisata = $request->nama_wisata;
        $wisata->jumlah_kk = $request->jumlah_kk;
        $wisata->jumlah_jiwa = $request->jumlah_jiwa;
        $wisata->latitude = $request->latitude;
        $wisata->longitude = $request->longitude;
        $wisata->keterangan = $request->keterangan;

        if ($wisata->save()) {
            return redirect()->back()->with('success', 'Berhasil mengubah data wisata');
        } else {
            return redirect()->back()->with('danger', 'Gagal mengubah data wisata');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wisata  $agama
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $wisata = Wisata::findOrFail($id);
            if ($wisata->foto != '') {
                Storage::delete($wisata->foto);
            }
            $wisata->delete();
            return back()->with(['success' => 'Berhasil menghapus data']);
        } catch (QueryException $e) {
            return back()->with(['danger' => 'Tidak dapat menghapus data karena ada keterkaitan data lain.']);
        } catch (\Exception $e) {
            return back()->with(['danger' => 'Terjadi kesalahan saat menghapus data.']);
        }
    }
}
