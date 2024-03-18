<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\Provinsi;

class ProvinsiController extends Controller
{
    public function index(){
        $data=Provinsi::first()
        ->get();
        return response()->json($data);
    }

    public function storeprov(Request $request){
        $data=Provinsi::create([
            'name'=> $request->name,

        ]);

        return response()->json(['message' => 'Berhasil di Simpan', 'data' =>$data], 200);
    }
    public function updateprov(Request $request){
        $data=Provinsi::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->update([
            'name'=> $request->name,

        ]);

        return response()->json('Success');
    }

    public function deleteprov(Request $request){

        $data=Provinsi::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->delete();

        return response()->json('Success');
    }
}
