<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\DesaDetail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DesaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Master Data Kampung',
            'desa' => Desa::all(),
        ];
        return view('pages.desa.index', $data);
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_desa' => ['required'],
                'jumlah_kk' => ['required'],
                'jumlah_jiwa' => ['required'],
                'latitude' => ['required'],
                'longitude' => ['required'],
                'foto' => ['nullable', 'mimes:jpeg,png,jpg,gif,webp'],
                'titles.*' => ['required'],
                'descriptions.*' => ['required'],
            ]);
            $desa = new Desa();
            if ($request->hasFile('foto')) {
                $filename = Str::random(32) . '.' . $request->file('foto')->getClientOriginalExtension();
                $file_path = $request->file('foto')->storeAs('public/fotos', $filename);
            }
            $desa->foto = isset($file_path) ? $file_path : '';
            $desa->nama_desa = $request->nama_desa;
            $desa->slug = Str::slug($request->nama_desa);
            $desa->jumlah_kk = $request->jumlah_kk;
            $desa->jumlah_jiwa = $request->jumlah_jiwa;
            $desa->latitude = $request->latitude;
            $desa->longitude = $request->longitude;
            $desa->keterangan = $request->keterangan;

            if ($desa->save()) {

                // Buat dan simpan data JSON pada model DesaDetail
                $desaDetail = new DesaDetail();
                $desaDetail->id_desa = $desa->id; // Pastikan model DesaDetail memiliki relasi ke model Desa
                $jsonData = [];

                foreach ($request->title as $key => $title) {
                    // Buat data JSON dari request
                    $itemData = [
                        'title' => $title, // Menggunakan $title dari form
                        'description' => $request->description[$key], // Menggunakan description sesuai dengan indeksnya
                    ];

                    // Tambahkan itemData ke array jsonData
                    $jsonData[] = $itemData;
                }

                // Setelah iterasi selesai, ubah $jsonData menjadi JSON dan simpan
                $desaDetail->data = json_encode($jsonData);
                $desaDetail->save();



                return redirect()->back()->with('success', 'Berhasil menambahkan kampung');
            } else {
                return redirect()->back()->with('danger', 'Gagal menambahkan kampung');
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
                'nama_desa' => ['required'],
                'jumlah_kk' => ['required'],
                'jumlah_jiwa' => ['required'],
                'latitude' => ['required'],
                'longitude' => ['required'],
                'foto' => ['nullable', 'mimes:jpeg,png,jpg,gif,webp'],
                'titles.*' => ['required'],
                'descriptions.*' => ['required'],
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
            $desa->slug = Str::slug($request->nama_desa);
            $desa->nama_desa = $request->nama_desa;
            $desa->jumlah_kk = $request->jumlah_kk;
            $desa->jumlah_jiwa = $request->jumlah_jiwa;
            $desa->latitude = $request->latitude;
            $desa->longitude = $request->longitude;
            $desa->keterangan = $request->keterangan;

            if ($desa->save()) {

                // hapus data sebelumnya
                DesaDetail::where('id_desa', $desa->id)->delete();
                // Buat dan simpan data JSON pada model DesaDetail
                $desaDetail = new DesaDetail();
                $desaDetail->id_desa = $desa->id; // Pastikan model DesaDetail memiliki relasi ke model Desa
                $jsonData = [];

                foreach ($request->title as $key => $title) {
                    // Buat data JSON dari request
                    if ($title !== null && trim($title) !== '') {
                        $itemData = [
                            'title' => $title,
                            'description' => $request->description[$key] ?? null, // Use null if description is not set
                        ];
                        $jsonData[] = $itemData;
                    }
                }
                // Setelah iterasi selesai, ubah $jsonData menjadi JSON dan simpan
                $desaDetail->data = json_encode($jsonData);
                $desaDetail->save();

                return redirect()->back()->with('success', 'Berhasil mengubah data kampung');
            } else {
                return redirect()->back()->with('danger', 'Gagal mengubah data kampung');
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
            $desa = Desa::findOrFail($id);
            if ($desa->foto != '') {
                Storage::delete($desa->foto);
            }
            $desa_detail = DesaDetail::where('id_desa', $desa->id);
            $desa_detail->delete();
            $desa->delete();
            return back()->with(['success' => 'Berhasil menghapus kampung']);
        } catch (QueryException $e) {
            return back()->with(['danger' => 'Tidak dapat menghapus kampung karena ada keterkaitan data lain.']);
        } catch (\Exception $e) {
            return back()->with(['danger' => 'Terjadi kesalahan saat menghapus kampung, ', $e->getMessage()]);
        }
    }
}
