<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Master Data Event',
            'kegiatan' => Kegiatan::all(),
        ];
        return view('pages.kegiatan.index', $data);
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_kegiatan' => ['required'],
                'tanggal_mulai' => ['required'],
                'tanggal_selesai' => ['required'],
                'latitude' => ['required'],
                'longitude' => ['required'],
                'foto' => ['nullable', 'mimes:jpeg,png,jpg,gif'],
            ]);
            $kegiatan = new Kegiatan();
            if ($request->hasFile('foto')) {
                $filename = Str::random(32) . '.' . $request->file('foto')->getClientOriginalExtension();
                $file_path = $request->file('foto')->storeAs('public/fotos', $filename);
            }
            $kegiatan->foto = isset($file_path) ? $file_path : '';
            $kegiatan->nama_kegiatan = $request->nama_kegiatan;
            $kegiatan->slug =  Str::slug($request->nama_kegiatan);
            $kegiatan->tanggal_mulai = $request->tanggal_mulai;
            $kegiatan->tanggal_selesai = $request->tanggal_selesai;
            $kegiatan->latitude = $request->latitude;
            $kegiatan->longitude = $request->longitude;
            $kegiatan->keterangan = $request->keterangan;

            if ($kegiatan->save()) {
                return redirect()->back()->with('success', 'Berhasil menambahkan desa');
            } else {
                return redirect()->back()->with('danger', 'Gagal menambahkan desa');
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
                'nama_kegiatan' => ['required'],
                'tanggal_mulai' => ['required'],
                'tanggal_selesai' => ['required'],
                'latitude' => ['required'],
                'longitude' => ['required'],
                'foto' => ['nullable', 'mimes:jpeg,png,jpg,gif'],
            ]);
            $kegiatan = Kegiatan::findOrFail($id);
            if ($request->hasFile('foto')) {
                if ($kegiatan->foto != '') {
                    Storage::delete($kegiatan->foto);
                }

                $filename = Str::random(32) . '.' . $request->file('foto')->getClientOriginalExtension();
                $file_path = $request->file('foto')->storeAs('public/fotos', $filename);
            }
            $kegiatan->foto = isset($file_path) ? $file_path : $kegiatan->foto;
            $kegiatan->slug =  Str::slug($request->nama_kegiatan);
            $kegiatan->nama_kegiatan = $request->nama_kegiatan;
            $kegiatan->tanggal_mulai = $request->tanggal_mulai;
            $kegiatan->tanggal_selesai = $request->tanggal_selesai;
            $kegiatan->latitude = $request->latitude;
            $kegiatan->longitude = $request->longitude;
            $kegiatan->keterangan = $request->keterangan;

            if ($kegiatan->save()) {
                return redirect()->back()->with('success', 'Berhasil mengubah data desa');
            } else {
                return redirect()->back()->with('danger', 'Gagal mengubah data desa');
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
            $kegiatan = Kegiatan::findOrFail($id);
            if ($kegiatan->foto != '') {
                Storage::delete($kegiatan->foto);
            }
            $kegiatan->delete();
            return back()->with(['success' => 'Berhasil menghapus data']);
        } catch (QueryException $e) {
            return back()->with(['danger' => 'Tidak dapat menghapus data karena ada keterkaitan data lain.']);
        } catch (\Exception $e) {
            return back()->with(['danger' => 'Terjadi kesalahan saat menghapus data.']);
        }
    }
}
