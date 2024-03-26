<?php

namespace App\Http\Controllers\JenisBiaya;

use App\Http\Controllers\Controller;
use App\Models\JenisBiaya\Biaya_Transportasi;
use App\Models\JenisBiaya\JenisBiaya;
use App\Models\JenisBiaya\Penginapan;
use App\Models\JenisBiaya\Pesawat;
use App\Models\JenisBiaya\Taksi;
use App\Models\JenisBiaya\UH_PerdinLuarKota;
use Illuminate\Http\JsonResponse;

class JenisBiayaController extends Controller
{
    public function jenisbiaya()
    {
        $data=JenisBiaya::all();
        return new JsonResponse($data);
    }
    public function uangharian()
    {
        $data=UH_PerdinLuarKota::first()
        ->where('provinsi_id', request('id_propinsi'))
        ->where('tingkatan_id', request('tingkatan'))
        ->get();

        return new JsonResponse($data);
    }
    public function penginapan()
    {
        $data=Penginapan::first()
        ->where('provinsi_id', request('id_propinsi'))
        ->where('golongan_id', request('golongan'))
        ->get();

        return new JsonResponse($data);

    }
    public function transport()
    {
        $data=Biaya_Transportasi::first()
        ->where('provinsi', request('provinsi'))
        ->where('kota', request('kota'))
        ->where('kendaraan', request('kendaraan'))
        ->get();

        return response()->json(['data' => $data]);

    }
    public function pesawat()
    {
        $data=Pesawat::first()
        ->where('tujuan', request('tujuan'))

        ->get();

        return response()->json(['data' => $data]);

    }
    public function taksi()
    {
        $data=Taksi::first()
        ->where('provinsi', request('provinsi'))
        ->get();

        return response()->json(['data' => $data]);

    }

}
