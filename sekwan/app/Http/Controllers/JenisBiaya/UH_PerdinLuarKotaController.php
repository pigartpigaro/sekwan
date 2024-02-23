<?php

namespace App\Http\Controllers\JenisBiaya;

use App\Http\Controllers\Controller;
use App\Models\JenisBiaya\UH_PerdinLuarKota;
use App\Models\Master\Kota_Kab;
use App\Models\Master\Provinsi;
use App\Models\Master\Satuan;
use App\Models\Master\Tingkatan;
use Illuminate\Http\Request;

class UH_PerdinLuarKotaController extends Controller
{
    public function index(){
        $data=UH_PerdinLuarKota::with(['provinsis','kotakabs','satuans'])
        ->get();
        return response()->json($data);
    }
    
    public function store(Request $request){
        $provinsi = Provinsi::where('id','=',$request->id_provinsi)->first();
        if(!$provinsi){
            return response()->json('NotValid',500);
        } 
        $satuan = Satuan::where('id','=',$request->id_satuan)->first();
        if(!$satuan){
            return response()->json('NotValid',500);
        } 
        $tingkat = Tingkatan::where('id','=',$request->id_tingkatan)->first();
        if(!$tingkat){
            return response()->json('NotValid',500);
        } 

        $data=UH_PerdinLuarKota::create([
            'id_provinsi'=> $request->id_provinsi,
            'id_satuan'=> $request->id_satuan,
            'id_tingkatan'=> $request->id_tingkatan,
            'biaya' => $request->biaya,      
        ]);

        return response()->json($data);
    }
    public function update(Request $request){

        $data = UH_PerdinLuarKota::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        } 
        $data->update([
            'id_provinsi'=> $request->id_provinsi,
            'id_satuan'=> $request->id_satuan,
            'id_tingkatan'=> $request->id_tingkatan,
            'biaya'=> $request->biaya,
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