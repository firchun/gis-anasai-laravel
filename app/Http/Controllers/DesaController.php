<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DesaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Master Data Desa',
            'desa' => Desa::all(),
        ];
        return view('pages.desa.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_desa' => ['required'],
            'jumlah_kk' => ['required'],
            'jumlah_jiwa' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'foto' => ['nullable', 'mimes:jpeg,png,jpg,gif'],
        ]);
        $desa = new Desa();
        if ($request->hasFile('foto')) {
            $filename = Str::random(32) . '.' . $request->file('foto')->getClientOriginalExtension();
            $file_path = $request->file('foto')->storeAs('public/fotos', $filename);
        }
        $desa->foto = isset($file_path) ? $file_path : '';
        $desa->nama_desa = $request->nama_desa;
        $desa->jumlah_kk = $request->jumlah_kk;
        $desa->jumlah_jiwa = $request->jumlah_jiwa;
        $desa->latitude = $request->latitude;
        $desa->longitude = $request->longitude;
        $desa->keterangan = $request->keterangan;

        if ($desa->save()) {
            return redirect()->back()->with('success', 'Berhasil menambahkan desa');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan desa');
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

        $request->validate([
            'nama_desa' => ['required'],
            'jumlah_kk' => ['required'],
            'jumlah_jiwa' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'foto' => ['nullable', 'mimes:jpeg,png,jpg,gif'],
        ]);
        $desa = Desa::findOrFail($id);
        if ($request->hasFile('foto')) {
            if ($desa->foto != '') {
                Storage::delete($desa->foto);
            }

            $filename = Str::random(32) . '.' . $request->file('foto')->getClientOriginalExtension();
            $file_path = $request->file('foto')->storeAs('public/fotos', $filename);
        }
        $desa->foto = isset($file_path) ? $file_path : $desa->foto;
        $desa->nama_desa = $request->nama_desa;
        $desa->jumlah_kk = $request->jumlah_kk;
        $desa->jumlah_jiwa = $request->jumlah_jiwa;
        $desa->latitude = $request->latitude;
        $desa->longitude = $request->longitude;
        $desa->keterangan = $request->keterangan;

        if ($desa->save()) {
            return redirect()->back()->with('success', 'Berhasil mengubah data desa');
        } else {
            return redirect()->back()->with('danger', 'Gagal mengubah data desa');
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
            $desa = Desa::findOrFail($id);
            if ($desa->foto != '') {
                Storage::delete($desa->foto);
            }
            $desa->delete();
            return back()->with(['success' => 'Berhasil menghapus data']);
        } catch (QueryException $e) {
            return back()->with(['danger' => 'Tidak dapat menghapus data karena ada keterkaitan data lain.']);
        } catch (\Exception $e) {
            return back()->with(['danger' => 'Terjadi kesalahan saat menghapus data.']);
        }
    }
}
