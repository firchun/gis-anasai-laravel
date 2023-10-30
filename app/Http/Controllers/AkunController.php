<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use DateTime;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function admin()
    {
        $data = [
            'title' => 'Data Akun Admin',
            'user' => User::where('role', 'admin')->get(),
        ];
        return view('pages.akun.admin.index', $data);
    }
    public function seller()
    {
        $data = [
            'title' => 'Data Akun Seller',
            'user' => User::where('role', 'seller')->get(),
        ];
        return view('pages.akun.seller.index', $data);
    }
    public function member()
    {
        $data = [
            'title' => 'Data Akun Member',
            'user' => User::where('role', 'member')->get(),
        ];
        return view('pages.akun.member.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
        ]);
        $akun = new User();

        $akun->name = $request->name;
        $akun->email = $request->email;
        $akun->phone = '+62' . $request->phone;
        $akun->role = 'admin';
        $akun->password = Hash::make('admin');
        $akun->email_verified_at = new DateTime();

        if ($akun->save()) {
            return redirect()->back()->with('success', 'Berhasil menambahkan admin');
        } else {
            return redirect()->back()->with('danger', 'Gagal menambahkan admin');
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
        ]);
        $akun = User::findOrFail($id);

        $akun->name = $request->name;
        $akun->email = $request->email;
        $akun->phone = $request->phone;

        if ($akun->save()) {
            return redirect()->back()->with('success', 'Berhasil mengubah admin');
        } else {
            return redirect()->back()->with('danger', 'Gagal mengubah admin');
        }
    }
    public function destroy($id)
    {

        try {
            $user = User::findOrFail($id);
            $user->delete();
            return back()->with(['success' => 'Berhasil menghapus data']);
        } catch (QueryException $e) {
            return back()->with(['danger' => 'Tidak dapat menghapus data karena ada keterkaitan data lain.']);
        } catch (\Exception $e) {
            return back()->with(['danger' => 'Terjadi kesalahan saat menghapus data.']);
        }
    }
}
