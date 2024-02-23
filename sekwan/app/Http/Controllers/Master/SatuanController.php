<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\Satuan;

class SatuanController extends Controller
{
    public function index(){
        $data=Satuan::get();
        return response()->json($data);
    }

    public function store(Request $request){
        $data=Satuan::create([
            'name'=> $request->name,
             
        ]);

        return response()->json($data);
    }
    public function update(Request $request){
        $data=Satuan::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }        
        $data->update([
            'name'=> $request->name,
            
        ]);

        return response()->json('Success');
    }

    public function delete(Request $request){
        
        $data=Satuan::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->delete();

        return response()->json('Success');
    }
}
