<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function read($id)
    {
        try {
            $notif = Notifikasi::findOrFail($id);
            $notif->read_at = Carbon::now();
            $notif->save();
            return redirect($notif->url);
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function read_all($id)
    {
        try {
            // Ubah semua notifikasi yang belum dibaca oleh user dengan id tertentu
            $notifikasi = Notifikasi::where('id_user', $id)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);

            if ($notifikasi) {
                return redirect()->back()->with('success', 'Notifikasi telah dibaca semua');
            } else {
                return redirect()->back()->with('danger', 'Tidak ada notifikasi yang dibaca');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
