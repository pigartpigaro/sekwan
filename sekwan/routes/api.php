<?php

use App\Http\Controllers\JenisBiaya\JenisBiayaController;
use App\Http\Controllers\JenisBiaya\Penginapan_dlmNegeriController;
use App\Http\Controllers\JenisBiaya\SemuaBiayaController;
use App\Http\Controllers\JenisBiaya\UH_PerdinLuarKotaController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Master\GolonganController;
use App\Http\Controllers\Master\Kepmen050Controller;
use App\Http\Controllers\Master\KotaKabController;
use App\Http\Controllers\Master\ProvinsiController;
use App\Http\Controllers\Master\SatuanController;
use App\Http\Controllers\Master\TingkatanController;
use App\Http\Controllers\Pelaksana\DewanController;
use App\Http\Controllers\Pelaksana\Flag_PegawaiController;
use App\Http\Controllers\Pelaksana\JabatanController;
use App\Http\Controllers\Pelaksana\KomisiController;
use App\Http\Controllers\Transaksi\Transaksi_PerdinController;
use App\Models\JenisBiaya\JenisBiaya;
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


    // route Tingkat / Golongan
    Route::get('/indextingkat', [TingkatanController::class, 'tingkat']);
    Route::get('/indexgol', [GolonganController::class, 'golongan']);



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


    // route Jabatan
    Route::get('/indexjabatan', [JabatanController::class, 'index']);
    Route::post('/storejabatan', [JabatanController::class, 'store']);
    Route::post('/updatejabatan', [JabatanController::class, 'update']);
    Route::post('/deletejabatan', [JabatanController::class, 'delete']);

    // route Komisi
    Route::get('/indexkomisi', [KomisiController::class, 'index']);
    Route::post('/storekomisi', [KomisiController::class, 'store']);
    Route::post('/updatekomisi', [KomisiController::class, 'update']);
    Route::post('/deletekomisi', [KomisiController::class, 'delete']);

    // route flagpegawai
    Route::get('/indexflagpgw', [Flag_PegawaiController::class, 'index']);
    Route::post('/storeflagpgw', [Flag_PegawaiController::class, 'store']);
    Route::post('/updateflagpgw', [Flag_PegawaiController::class, 'update']);
    Route::post('/deleteflagpgw', [Flag_PegawaiController::class, 'delete']);


    // route Jenis Biaya
    Route::get('/jenisbiaya', [JenisBiayaController::class, 'jenisbiaya']);
    Route::get('/uangharian', [JenisBiayaController::class, 'uangharian']);
    Route::get('/penginapan', [JenisBiayaController::class, 'penginapan']);
    Route::get('/transport', [JenisBiayaController::class, 'transport']);
    Route::get('/pesawat', [JenisBiayaController::class, 'pesawat']);
    Route::get('/taksi', [JenisBiayaController::class, 'taksi']);


    // Transaksi
    Route::get('/index', [Transaksi_PerdinController::class, 'index']);
    Route::post('/store', [Transaksi_PerdinController::class, 'storeheader']);
    Route::post('/storerinci', [Transaksi_PerdinController::class, 'storerinci']);
});

