<?php

use App\Http\Controllers\DesaController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\ProfileController;
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
