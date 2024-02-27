<?php

namespace App\Http\Controllers\Pelaksana;

use App\Http\Controllers\Controller;
use App\Models\Pelaksana\Dewan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DewanController extends Controller
{
    public function index(){
        // $data=Dewan::get();
        // $data = DB::table('dewans')->select('id','nama','nik', 'komisi')->get();
        $data = DB::table('dewans')->whereIn('status', [0, 1])->get();
        return response()->json($data);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'nik'  => 'required|unique:dewans',
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $data=Dewan::create([
            'nama'=> $request->nama,
            'nik'=> $request->nik,
            'jns_kelamin'=> $request->jns_kelamin,
            'alamat'=> $request->alamat,
            'jabatan'=> $request->jabatan,
            'komisi'=> $request->komisi,
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
            'nik'=> $request->nik,
            'jns_kelamin'=> $request->jns_kelamin,
            'alamat'=> $request->alamat,
            'jabatan'=> $request->jabatan,
            'komisi'=> $request->komisi,
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
