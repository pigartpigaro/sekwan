<?php

namespace App\Http\Controllers\JenisBiaya;

use App\Http\Controllers\Controller;
use App\Models\JenisBiaya\Penginapan_dlmNegeri;
use App\Models\Master\Golongan;
use App\Models\Master\Provinsi;
use App\Models\Master\Satuan;
use Illuminate\Http\Request;

class Penginapan_dlmNegeriController extends Controller
{
    public function index()
    {
        $data=Penginapan_dlmNegeri::all();

        return response()->json($data);

    }

    public function store(Request $request){
        $provinsi = Provinsi::where('id','=',$request->id_provinsi)->first();
        if(!$provinsi){
            return response()->json('NotValid',500);
        }
        $gol = Golongan::where('id','=',$request->id_golongan)->first();
        if(!$gol){
            return response()->json('NotValid',500);
        }

        $data=Penginapan_dlmNegeri::create([
            'nama'=> $request->nama,
            'id_provinsi'=> $request->id_provinsi,
            'satuan'=> $request->satuan,
            'id_golongan'=> $request->id_golongan,
            'biaya'=> $request->biaya,
        ]);

        return response()->json($data);
    }
    public function update(Request $request){

        $data = Penginapan_dlmNegeri::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->update([
            'nama'=> $request->nama,
            'id_provinsi'=> $request->id_provinsi,
            'satuan'=> $request->satuan,
            'id_golongan'=> $request->id_golongan,
            'biaya'=> $request->biaya,
        ]);

        return response()->json('Success');
    }

    public function delete(Request $request){
        $data=Penginapan_dlmNegeri::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->delete();

        return response()->json('Success');
    }
}
