<?php

use App\Http\Controllers\api\MarkerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/get_all_desa', [MarkerController::class, 'get_all_desa'])->name('get_all_desa');
Route::get('/get_all_kegiatan', [MarkerController::class, 'get_all_kegiatan'])->name('get_all_kegiatan');
