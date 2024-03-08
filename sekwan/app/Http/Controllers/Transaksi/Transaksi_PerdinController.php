<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\JenisBiaya\UH_PerdinLuarKota;
use App\Models\Pelaksana\Dewan;
use App\Models\Transaksi\Transaksi_Perdin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Transaksi_PerdinController extends Controller
{
    public function uangharian(){
        $perdin = Transaksi_Perdin::with('dewan','perdin')
        ->get();
        return new JsonResponse($perdin);
    }
    public function store(Request $request)
    {

        // $validator = Validator::make($request->all(), [
        //     'nik'  => 'required|unique:dewans',
        // ]);

        // //if validation fails
        // if ($validator->fails()) {
        //     return response()->json(['message' => 'NIK Sudah Tersedia', 'data' => $validator], 422);
        // }
        $xy = Dewan::where('nama','=',$request->nama)
        ->where('nik','=',$request->nik)
        ->first();
        if(!$xy){
            return new JsonResponse(['message' => 'data jabatan tidak ditemukan', 'data' => $xy], 501);
        }
        $xyz = UH_PerdinLuarKota::where('name','=',$request->perdin)
        ->where('id_provinsi', '=',$request->provinsi)
        ->first();
        if(!$xyz){
            return new JsonResponse(['message' => 'data jabatan tidak ditemukan', 'data' => $xyz], 501);
        }

        $data = Transaksi_Perdin::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'perdin' => $request->perdin,
            'provinsi'=> $request->provinsi
        ]);

        return response()->json(['message' => 'Berhasil di Simpan', 'data' => $data], 200);
    }
}
