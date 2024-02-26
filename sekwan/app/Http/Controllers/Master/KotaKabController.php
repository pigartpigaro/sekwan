<?php

namespace App\Http\Controllers\Master;

use App\Models\Master\Kota_Kab;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KotaKabController extends Controller
{
    public function index(){
        $data=Kota_Kab::get();
        return response()->json($data);
    }

    public function store(Request $request){
        $data=Kota_Kab::create([
            'name'=> $request->name,

        ]);

        return response()->json($data);
    }
    public function update(Request $request){
        $data=Kota_Kab::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->update([
            'name'=> $request->name,

        ]);

        return response()->json('Success');
    }

    public function delete(Request $request){

        $data=Kota_Kab::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->delete();

        return response()->json('Success');
    }
}
