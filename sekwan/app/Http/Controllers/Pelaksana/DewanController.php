<?php

namespace App\Http\Controllers\Pelaksana;

use App\Http\Controllers\Controller;
use App\Models\Pelaksana\Dewan;
use Illuminate\Http\Request;

class DewanController extends Controller
{
    public function index(){
        $data=Dewan::get();
        return response()->json($data);
    }

    public function store(Request $request){
        
        $data=Dewan::create([
            'nama'=> $request->nama,
            'jabatan'=> $request->jabatan,
            'nik'=> $request->nik,
            'komisi'=> $request->komisi,
            'status'=> $request->status,    
        ]);
       
        return response()->json($data);
    }
    public function update(Request $request){
        $data=Dewan::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }        

        $data->update([
            'nama'=> $request->nama,
            'jabatan'=> $request->jabatan,
            'nik'=> $request->nik,
            'komisi'=> $request->komisi,
            'status'=> $request->status,
        ]);

        return response()->json('Success');
    }

    public function delete(Request $request){
        
        $data=Dewan::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->delete();

        return response()->json('Success');
    }
    public function status($id){
        $data = Dewan::where('id',$id)->first();
 
        $aktif = $data->status;
 
        if($aktif == 1){
             Dewan::where('id',$id)->update([
                'status'=>0
            ]);
        }else{
             Dewan::where('id',$id)->update([
                'status'=>1
            ]);
        }
        return response()->json('Success','Status change successfully');
        
        // $dewan = Dewan::find($id);
        // $dewan->status = $id->status;
        // $dewan->save();
  
        // return response()->json('Success','Status change successfully');
    
        }
    }