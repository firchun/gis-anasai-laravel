<?php

namespace App\Http\Controllers;

use App\Models\Lapak;
use App\Models\Notifikasi;
use App\Models\reviewRating;
use App\Models\User;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewRatingController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'star_rating' => ['required', 'string', 'max:255'],
                'identity' => ['required', 'string', 'max:255'],
                'type' => ['required', 'string', 'max:255'],
            ]);
            //create rating
            $rating = new reviewRating();
            $rating->identity = $request->identity;
            $rating->type = $request->type;
            $rating->comments = $request->comments;
            $rating->star_rating = $request->star_rating;
            $rating->id_user = Auth::user()->id;


            if ($request->star_rating > 2) {
                $type = 'success';
            } elseif ($request->star_rating == 1) {
                $type = 'warning';
            } else {
                $type = 'primary';
            }
            if ($request->type == 'lapak') {

                $id_user = Lapak::find($request->identity)->id_user;

                $notifikasi = new Notifikasi();
                $notifikasi->id_user = $id_user;
                $notifikasi->type = $type;
                $notifikasi->message = 'Lapak anda mendapat Rating ' . $request->star_rating . ' dari pengunjung';
                $notifikasi->url = '/lapak';
                $notifikasi->save();
            } else {
                $admin = User::where('role', 'admin')->get();

                $type_url = $request->type == 'wisata' ? '/wisata' : '/kegiatan';

                foreach ($admin as $user) {
                    $notifikasi = new Notifikasi();
                    $notifikasi->id_user = $user->id;
                    $notifikasi->type = $type;
                    $notifikasi->message = $request->type . ' mendapat Rating ' . $request->star_rating . ' dari pengunjung';
                    $notifikasi->url = $type_url;
                    $notifikasi->save();
                }
            }


            if ($rating->save()) {
                return redirect()->back()->with('success', 'Berhasil klaim');
            } else {
                return redirect()->back()->with('danger', 'Gagal klaim');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan : ' . $e->getMessage());
        }
    }
}
