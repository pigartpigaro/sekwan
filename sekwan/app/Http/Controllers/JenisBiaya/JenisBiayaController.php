<?php

namespace App\Http\Controllers\JenisBiaya;

use App\Http\Controllers\Controller;
use App\Models\JenisBiaya\Biaya_Transportasi;
use App\Models\JenisBiaya\Penginapan;
use App\Models\JenisBiaya\Pesawat;
use App\Models\JenisBiaya\Taksi;
use App\Models\JenisBiaya\UH_PerdinLuarKota;


class JenisBiayaController extends Controller
{
    public function uangharian(){
        $data=UH_PerdinLuarKota::first()
        ->with(['provinsi', 'tingkatan'])
        ->paginate(request('per_page'));

        return response()->json(['data' => $data]);
    }
    public function penginapan()
    {
        $data=Penginapan::first()
        ->with(['provinsi', 'golongan'])
        ->paginate(request('per_page'));

        return response()->json(['data' => $data]);

    }
    public function transport()
    {
        $data=Biaya_Transportasi::first()
        ->with(['provinsi', 'kota'])
        ->paginate(request('per_page'));

        return response()->json(['data' => $data]);

    }
    public function pesawat()
    {
        $data=Pesawat::first()

        ->paginate(request('per_page'));

        return response()->json(['data' => $data]);

    }
    public function taksi()
    {
        $data=Taksi::first()
        ->with(['provinsi'])
        ->paginate(request('per_page'));

        return response()->json(['data' => $data]);

    }

}
