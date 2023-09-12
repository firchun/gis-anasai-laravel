<?php

use App\Http\Controllers\DesaController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LapakController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WisataController;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [FrontController::class, 'index']);
Route::get('/village', [FrontController::class, 'desa'])->name('village');
Route::get('/event', [FrontController::class, 'event'])->name('event');
Route::get('/merchandise', [FrontController::class, 'merchandise'])->name('merchandise');

Auth::routes(['verify' => true]);

//route dashboard
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);
//route profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
//route desa
Route::get('/desa', [DesaController::class, 'index'])->name('desa');
Route::post('/desa/store', [DesaController::class, 'store'])->name('desa.store');
Route::put('/desa/update/{id}', [DesaController::class, 'update'])->name('desa.update');
Route::delete('/desa/destroy/{id}', [DesaController::class, 'destroy'])->name('desa.destroy');
//route kegiatan
Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan');
Route::post('/kegiatan/store', [KegiatanController::class, 'store'])->name('kegiatan.store');
Route::put('/kegiatan/update/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
Route::delete('/kegiatan/destroy/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');
//route wisata
Route::get('/wisata', [WisataController::class, 'index'])->name('wisata');
Route::post('/wisata/store', [WisataController::class, 'store'])->name('wisata.store');
Route::put('/wisata/update/{id}', [WisataController::class, 'update'])->name('wisata.update');
Route::delete('/wisata/destroy/{id}', [WisataController::class, 'destroy'])->name('wisata.destroy');
//route lapak
Route::get('/lapak', [LapakController::class, 'index'])->name('lapak');
Route::post('/lapak/store', [LapakController::class, 'store'])->name('lapak.store');
Route::put('/lapak/update/{id}', [LapakController::class, 'update'])->name('lapak.update');
Route::delete('/lapak/destroy/{id}', [LapakController::class, 'destroy'])->name('lapak.destroy');
//produk
Route::get('/lapak/produk/{id}', [LapakController::class, 'produk_lapak'])->name('lapak.produk');
Route::post('/lapak/produk/store', [LapakController::class, 'store_produk'])->name('lapak.produk.store');
Route::post('/lapak/produk/store_stok', [LapakController::class, 'store_stok'])->name('lapak.produk.store_stok');
Route::put('/lapak/produk/update/{id}', [LapakController::class, 'update_produk'])->name('lapak.produk.update');
Route::delete('/lapak/produk/destroy/{id}', [LapakController::class, 'destroy_produk'])->name('lapak.produk.destroy');
