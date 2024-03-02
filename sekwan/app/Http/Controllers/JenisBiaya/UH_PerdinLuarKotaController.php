<?php

namespace App\Http\Controllers\JenisBiaya;

use App\Http\Controllers\Controller;
use App\Models\JenisBiaya\UH_PerdinLuarKota;
use App\Models\Master\Provinsi;
use App\Models\Master\Tingkatan;
use Illuminate\Http\Request;

class UH_PerdinLuarKotaController extends Controller
{
    public function index(){
        $data=UH_PerdinLuarKota::latest()
        ->with(['provinsi', 'tingkatan'])
        ->paginate(request('per_page'));

        return response()->json(['data' => $data]);
    }

    public function store(Request $request){
        $provinsi = Provinsi::where('id','=',$request->id_provinsi)->first();
        if(!$provinsi){
            return response()->json('NotValid',500);
        }
        $tingkat = Tingkatan::where('id','=',$request->id_tingkatan)->first();
        if(!$tingkat){
            return response()->json('NotValid',500);
        }

        $data=UH_PerdinLuarKota::create([
            'id_provinsi'=> $request->id_provinsi,
            'satuan'=> $request->satuan,
            'id_tingkatan'=> $request->id_tingkatan,
            'biaya' => $request->biaya,
            'nama' =>$request->nama,
        ]);

        return response()->json(['message' => 'Berhasil di Simpan', 'data' =>$data], 200);
    }
    public function update(Request $request){

        $data = UH_PerdinLuarKota::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->update([
            'id_provinsi'=> $request->id_provinsi,
            'satuan'=> $request->satuan,
            'id_tingkatan'=> $request->id_tingkatan,
            'biaya'=> $request->biaya,
            'nama' =>$request->nama,
        ]);

        return response()->json('Success');
    }

    public function delete(Request $request){
        $data=UH_PerdinLuarKota::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->delete();

        return response()->json('Success');
    }

}
