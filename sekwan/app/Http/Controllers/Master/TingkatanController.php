<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Tingkatan;
use Illuminate\Http\Request;

class TingkatanController extends Controller
{
    public function index(){
        $data=Tingkatan::get();
        return response()->json($data);
    }

    public function store(Request $request){
        $data=Tingkatan::create([
            'name'=> $request->name,

        ]);

        return response()->json(['message' => 'Berhasil di Simpan', 'data' =>$data], 200);
    }
    public function update(Request $request){
        $data=Tingkatan::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->update([
            'name'=> $request->name,

        ]);

        return response()->json('Success');
    }

    public function delete(Request $request){

        $data=Tingkatan::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->delete();

        return response()->json('Success');
    }
}
