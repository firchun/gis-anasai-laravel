<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agama;
use App\Models\Bidang;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PendidikanTerakhir;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'title' => 'Profile',
        ];

        return view('pages.akun.profile', $data);
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
                'current_password' => 'nullable|required_with:new_password',
                'new_password' => 'nullable|min:8|max:12|required_with:current_password',
                'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password'
            ]);

            $user = User::findOrFail(Auth::user()->id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            if (!is_null($request->input('current_password'))) {
                if (Hash::check($request->input('current_password'), $user->password)) {
                    $user->password = $request->input('new_password');
                } else {
                    throw new Exception('Password saat ini tidak benar.');
                }
            }

            $user->save();

            return back()->withSuccess('Profil berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->withErrors(['danger' => $e->getMessage()]);
        }
    }
}
