<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:web', 'role:admin,seller']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
        ];
        return view('pages.dashboard.home', $data);
    }
    public function notifikasi()
    {
        $data = [
            'title' => 'Semua Notifikasi',
            'notifikasi' => Notifikasi::where('id_user', Auth::user()->id)->get(),
        ];
        return view('pages.notifikasi.notifikasi', $data);
    }
}
