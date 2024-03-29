<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LapakController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewRatingController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\NotifikasiController;
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
Route::get('/search', [FrontController::class, 'search'])->name('search');
Route::get('/village', [FrontController::class, 'desa'])->name('village');
Route::get('/village/detail/{slug}', [FrontController::class, 'desa_detail'])->name('village.detail');
Route::get('/event', [FrontController::class, 'event'])->name('event');
Route::get('/event/detail/{slug}', [FrontController::class, 'event_detail'])->name('event.detail');
Route::get('/tour', [FrontController::class, 'wisata'])->name('tour');
Route::get('/tour/detail/{slug}', [FrontController::class, 'wisata_detail'])->name('tour.detail');
Route::get('/merchandise', [FrontController::class, 'merchandise'])->name('merchandise');
Route::get('/merchandise/detail/{slug}', [FrontController::class, 'merchandise_detail'])->name('merchandise.detail');
Route::get('/shop', [FrontController::class, 'shop'])->name('shop');
Route::get('/shop/detail/{slug}', [FrontController::class, 'shop_detail'])->name('shop.detail');

//rating
Route::post('/review/store', [ReviewRatingController::class, 'store'])->name('review.store');


Auth::routes(['verify' => true]);
Route::middleware(['auth:web'])->group(function () {
    // Notifikasi
    Route::put('/readChat/{id}', [ChatController::class, 'readChat'])->name('read_chat');
    Route::put('/read_notif/{id}', [NotifikasiController::class, 'read'])->name('read_notif');
    Route::put('/read_all/{id}', [NotifikasiController::class, 'read_all'])->name('read_all');
    Route::get('/notifikasi', [HomeController::class, 'notifikasi'])->name('notifikasi');

    Route::get('/chat/user/{user}', [App\Http\Controllers\ChatController::class, 'chat'])->name('chat');
    Route::get('/chat/room/{room}', [App\Http\Controllers\ChatController::class, 'room'])->name('chat.room');
    Route::get('/chat/get/{room}', [App\Http\Controllers\ChatController::class, 'getChat'])->name('chat.get');
    Route::post('/chat/send', [App\Http\Controllers\ChatController::class, 'sendChat'])->name('chat.send');
});
Route::middleware(['auth:web', 'role:admin,seller'])->group(function () {
    //route dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);
    //route chat
    Route::get('/lapak/chat', [ChatController::class, 'lapak'])->name('lapak.chat');
    //route profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    //route lapak
    Route::get('/lapak', [LapakController::class, 'index'])->name('lapak');
    Route::post('/lapak/store', [LapakController::class, 'store'])->name('lapak.store');
    Route::put('/lapak/update/{id}', [LapakController::class, 'update'])->name('lapak.update');
    Route::delete('/lapak/destroy/{id}', [LapakController::class, 'destroy'])->name('lapak.destroy');
    //route produk
    Route::get('/lapak/produk/{id}', [LapakController::class, 'produk_lapak'])->name('lapak.produk');
    Route::post('/lapak/produk/store', [LapakController::class, 'store_produk'])->name('lapak.produk.store');
    Route::post('/lapak/produk/store_stok', [LapakController::class, 'store_stok'])->name('lapak.produk.store_stok');
    Route::put('/lapak/produk/update/{id}', [LapakController::class, 'update_produk'])->name('lapak.produk.update');
    Route::delete('/lapak/produk/destroy/{id}', [LapakController::class, 'destroy_produk'])->name('lapak.produk.destroy');
});
Route::middleware(['auth:web', 'role:admin'])->group(function () {
    //route pengguna
    //pengguna : admin
    Route::get('/admin', [AkunController::class, 'admin'])->name('admin');
    Route::post('/admin/store', [AkunController::class, 'store'])->name('admin.store');
    Route::put('/admin/update/{id}', [AkunController::class, 'update'])->name('admin.update');
    Route::delete('/admin/destroy/{id}', [AkunController::class, 'destroy'])->name('admin.destroy');
    //pengguna : seller
    Route::get('/seller', [AkunController::class, 'seller'])->name('seller');
    //pengguna : member
    Route::get('/member', [AkunController::class, 'member'])->name('member');

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
    Route::post('/wisata/storeFoto', [WisataController::class, 'storeFoto'])->name('wisata.storeFoto');
    Route::put('/wisata/update/{id}', [WisataController::class, 'update'])->name('wisata.update');
    Route::get('/wisata/images/{id}', [WisataController::class, 'images'])->name('wisata.images');
    Route::delete('/wisata/destroy/{id}', [WisataController::class, 'destroy'])->name('wisata.destroy');
    Route::delete('/wisata/destroy_images/{id}', [WisataController::class, 'destroy_images'])->name('wisata.destroy_images');

    //route laporan
    Route::get('/laporan/wisata', [LaporanController::class, 'wisata'])->name('laporan.wisata');
    Route::get('/laporan/exportWisata', [LaporanController::class, 'exportWisata'])->name('laporan.exportWisata');
    Route::get('/laporan/lapak', [LaporanController::class, 'lapak'])->name('laporan.lapak');
    Route::get('/laporan/exportLapak', [LaporanController::class, 'exportLapak'])->name('laporan.exportLapak');
    Route::get('/laporan/desa', [LaporanController::class, 'desa'])->name('laporan.desa');
    Route::get('/laporan/exportDesa', [LaporanController::class, 'exportDesa'])->name('laporan.exportDesa');
    Route::get('/laporan/kegiatan', [LaporanController::class, 'kegiatan'])->name('laporan.kegiatan');
    Route::get('/laporan/exportKegiatan', [LaporanController::class, 'exportKegiatan'])->name('laporan.exportKegiatan');
});
