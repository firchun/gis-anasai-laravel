<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

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
            'user' => Member::where('role', 'member')->get(),
        ];
        return view('pages.akun.member.index', $data);
    }
}
