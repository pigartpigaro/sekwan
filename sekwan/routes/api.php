<?php

use App\Http\Controllers\JenisBiaya\Penginapan_dlmNegeriController;
use App\Http\Controllers\JenisBiaya\UH_PerdinLuarKotaController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Master\GolonganController;
use App\Http\Controllers\Master\Kepmen050Controller;
use App\Http\Controllers\Master\KotaKabController;
use App\Http\Controllers\Master\ProvinsiController;
use App\Http\Controllers\Master\SatuanController;
use App\Http\Controllers\Master\TingkatanController;
use App\Http\Controllers\Pelaksana\DewanController;
use App\Http\Controllers\Pelaksana\JabatanController;
use App\Http\Controllers\Pelaksana\KomisiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware(['cors'])->group(function () {
//     Route::get('/indexdewan', [DewanController::class, 'index']);
// });

// route login
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [LoginController::class, 'register']);

// route provinsi
Route::group(['middleware' => ['api']], function() {
    Route::get('/indexprov', [ProvinsiController::class, 'index']);
    Route::post('/storeprov', [ProvinsiController::class, 'storeprov']);
    Route::post('/updateprov', [ProvinsiController::class, 'updateprov']);
    Route::post('/deleteprov', [ProvinsiController::class, 'deleteprov']);

    // route kotakab
    Route::get('/indexkab', [KotaKabController::class, 'index']);
    Route::post('/storekab', [KotaKabController::class, 'store']);
    Route::post('/updatekab', [KotaKabController::class, 'update']);
    Route::post('/deletekab', [KotaKabController::class, 'delete']);


    // route Tingkat
    Route::get('/indextingkat', [TingkatanController::class, 'index']);
    Route::post('/storetingkat', [TingkatanController::class, 'store']);
    Route::post('/updatetingkat', [TingkatanController::class, 'update']);
    Route::post('/deletetingkat', [TingkatanController::class, 'delete']);


    // route Golongan
    Route::get('/indexgol', [GolonganController::class, 'index']);
    Route::post('/storegol', [GolonganController::class, 'store']);
    Route::post('/updategol', [GolonganController::class, 'update']);
    Route::post('/deletegol', [GolonganController::class, 'delete']);

    // route rekening 050
    Route::get('/indexkepmen', [Kepmen050Controller::class, 'index']);
    Route::post('/storekepmen', [Kepmen050Controller::class, 'store']);
    Route::post('/updatekepmen', [Kepmen050Controller::class, 'update']);
    Route::post('/deletekepmen', [Kepmen050Controller::class, 'delete']);


    // route Dewan
    Route::get('/indexdewan', [DewanController::class, 'index']);
    Route::post('/storedewan', [DewanController::class, 'store']);
    Route::post('/updatedewan', [DewanController::class, 'update']);
    Route::post('/deletedewan', [DewanController::class, 'delete']);
    Route::post('/statusdewan', [DewanController::class, 'status']);
    Route::post('/pegawai', [DewanController::class, 'pegwai']);

    // route Jabata
    Route::get('/indexjabatan', [JabatanController::class, 'index']);
    Route::post('/storejabatan', [JabatanController::class, 'store']);
    Route::post('/updatejabatan', [JabatanController::class, 'update']);
    Route::post('/deletejabatan', [JabatanController::class, 'delete']);

    // route Komisi
    Route::get('/indexkomisi', [KomisiController::class, 'index']);
    Route::post('/storekomisi', [KomisiController::class, 'store']);
    Route::post('/updatekomisi', [KomisiController::class, 'update']);
    Route::post('/deletekomisi', [KomisiController::class, 'delete']);
    Route::post('/status/{id}', [KomisiController::class, 'status']);


    // route UangHarian
    Route::get('/indexuangharian', [UH_PerdinLuarKotaController::class, 'index']);
    Route::post('/storeuangharian', [UH_PerdinLuarKotaController::class, 'store']);
    Route::post('/updateuangharian', [UH_PerdinLuarKotaController::class, 'update']);
    Route::post('/deleteuangharian', [UH_PerdinLuarKotaController::class, 'delete']);

    // route UangHarian
    Route::get('/indexpenginapan', [Penginapan_dlmNegeriController::class, 'index']);
    Route::post('/storepenginapan', [Penginapan_dlmNegeriController::class, 'store']);
    Route::post('/updatepenginapan', [Penginapan_dlmNegeriController::class, 'update']);
    Route::post('/deletepenginapan', [Penginapan_dlmNegeriController::class, 'delete']);
});

