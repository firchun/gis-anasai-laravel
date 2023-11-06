<?php

namespace App\Http\Controllers;

use App\Models\reviewRating;
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
