<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\WisataFoto;
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
    public function images($id)
    {
        $wisata = Wisata::findOrFail($id);
        $images = WisataFoto::where('id_wisata', $wisata->id)->get();
        $data = [
            'title' => 'Gambar pada wisata : ' . $wisata->nama_wisata,
            'wisata' => $wisata,
            'images' => $images,
        ];
        return view('pages.wisata.images', $data);
    }
    public function store(Request $request)
    {

        // try {
        $request->validate([
            'nama_wisata' => ['required'],
            'harga' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'foto' => ['nullable', 'mimes:jpeg,png,jpg,gif'],
            'foto_wisatas.*' => ['required', 'mimes:jpeg,png,jpg'],
            'titles.*' => ['required'],
            'descriptions.*' => ['required'],
        ]);

        $wisata = new Wisata();

        if ($request->hasFile('foto')) {
            $filename = Str::random(32) . '.' . $request->file('foto')->getClientOriginalExtension();
            $file_path = $request->file('foto')->storeAs('public/fotos', $filename);
            $wisata->foto = $file_path;
        }

        $wisata->nama_wisata = $request->nama_wisata;
        $wisata->slug = Str::slug($request->nama_wisata);
        $wisata->harga = $request->harga;
        $wisata->latitude = $request->latitude;
        $wisata->longitude = $request->longitude;
        $wisata->keterangan = $request->keterangan;

        if ($wisata->save()) {
            if ($request->hasFile('foto_wisata')) {
                foreach ($request->file('foto_wisata') as $key => $photo) {
                    // Upload the photo
                    $path = $photo->store('public/fotos'); // Change 'fotos' to the appropriate storage folder

                    // Create a new data entry
                    $dataEntry = new WisataFoto();
                    $dataEntry->id_wisata = $wisata->id;
                    $dataEntry->title = $request->title[$key];
                    $dataEntry->description = $request->description[$key];
                    $dataEntry->foto = $path;

                    // Save the data entry
                    $dataEntry->save();
                }
            }

            return redirect()->back()->with('success', 'Berhasil menambahkan wisata');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan wisata');
        }
        // } catch (\Exception $e) {
        //     return redirect()->back()->with('danger', 'Terjadi kesalahan: ' . $e->getMessage());
        // }
    }
    public function storeFoto(Request $request)
    {
        try {
            $request->validate([
                'foto_wisatas.*' => ['required', 'mimes:jpeg,png,jpg'],
                'titles.*' => ['required'],
                'id_wisatas.*' => ['required'],
                'descriptions.*' => ['required'],
            ]);

            if ($request->hasFile('foto_wisata')) {
                foreach ($request->file('foto_wisata') as $key => $photo) {
                    // Upload the photo
                    $path = $photo->store('public/fotos'); // Change 'fotos' to the appropriate storage folder

                    // Create a new data entry
                    $dataEntry = new WisataFoto();
                    $dataEntry->id_wisata = $request->id_wisata[$key];
                    $dataEntry->title = $request->title[$key];
                    $dataEntry->description = $request->description[$key];
                    $dataEntry->foto = $path;

                    // Save the data entry
                    $dataEntry->save();
                }
            }

            return redirect()->back()->with('success', 'Foto-foto berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan : ' . $e->getMessage());
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
        try {
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
            $wisata->slug =  Str::slug($request->nama_wisata);
            $wisata->latitude = $request->latitude;
            $wisata->longitude = $request->longitude;
            $wisata->keterangan = $request->keterangan;

            if ($wisata->save()) {
                return redirect()->back()->with('success', 'Berhasil mengubah data wisata');
            } else {
                return redirect()->back()->with('danger', 'Gagal mengubah data wisata');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan : ' . $e->getMessage());
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
