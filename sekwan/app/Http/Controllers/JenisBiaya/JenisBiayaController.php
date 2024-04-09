<?php

namespace App\Http\Controllers\JenisBiaya;

use App\Http\Controllers\Controller;
use App\Models\JenisBiaya\Biaya_Transportasi;
use App\Models\JenisBiaya\JenisBiaya;
use App\Models\JenisBiaya\Penginapan;
use App\Models\JenisBiaya\Pesawat;
use App\Models\JenisBiaya\Taksi;
use App\Models\JenisBiaya\UH_PerdinLuarKota;
use App\Models\Master\Kendaraan;
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
        ->where('provinsi_id', request('id_propinsi'))
        ->where('kota_kabs_id', request('kota'))
        ->where('kendaraan_id', request('kendaraan'))
        ->get();

        return response()->json(['data' => $data]);

    }
    public function pesawat()
    {
        $tujuan = request('tujuan');
        // if ($tujuan !== null ) {
        //     $data=Pesawat::where('id', $tujuan)
        //     ->orderBy('tujuan', 'desc')
        //     ->get();

        // }
        if(request('kelas') === 'Bisnis'){
            $data=Pesawat::where('id',$tujuan)
            ->orderBy('tujuan', 'desc')
            ->get();
        }
        else{
            $data=Pesawat::first()
            ->orderBy('tujuan', 'desc')
            ->get();
        }

        return response()->json(['data' => $data]);

    }

    public function taksi()
    {
        $data=Taksi::first()
        ->where('provinsi_id', request('id_propinsi'))
        ->get();

        return response()->json(['data' => $data]);

    }
    public function kendaraan(){
        $data=Kendaraan::get();
        return response()->json($data);
    }
}
