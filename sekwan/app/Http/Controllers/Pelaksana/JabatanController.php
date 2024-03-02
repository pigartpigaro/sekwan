<?php

namespace App\Http\Controllers\Pelaksana;

use App\Http\Controllers\Controller;
use App\Models\Pelaksana\Jabatan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index(){
        $data=Jabatan::latest()
        ->where('jenis', request('q'))
        ->paginate(request('per_page'));
        return response()->json($data);
    }

    public function store(Request $request){
        $data=Jabatan::create([
            'jenis'=> $request->jenis,

        ]);

        return new JsonResponse(['message' => 'Berhasil di Simpan', 'data' => $data], 200);
    }
    public function update(Request $request){
        $data=Jabatan::find($request->id);
        if(!$data){
            return new JsonResponse(['message' => 'Gagal Update', 'data' => $data], 200);
        }
        $data->update([
            'jenis'=> $request->jenis,
        ]);

        return new JsonResponse(['message' => 'Berhasil di Update', 'data' => $data], 200);
    }

    public function delete(Request $request){

        $data=Jabatan::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->delete();

        return response()->json('Success');
    }
}
