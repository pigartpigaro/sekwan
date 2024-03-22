<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Kepmen050;
use Illuminate\Http\Request;

class Kepmen050Controller extends Controller
{
    public function index(){
        $data=Kepmen050::where('akun',5)
        ->where('kelompok',1)

        ->paginate(request('per_page'));
        return response()->json($data);
    }
    public function store(Request $request){
        $data=Kepmen050::create([
            'akun' => $request->akun,
            'kelompok' => $request->kelompok,
            'jenis' => $request->jenis,
            'objek' => $request->objek,
            'rincian_objek' => $request->rincian_objek,
            'subrincian_objek' => $request->subrincian_objek,
            'uraian' => $request->uraian,
        ]);
        return response()->json(['message' => 'Berhasil di Simpan', 'data' =>$data], 200);
    }
    public function update(Request $request){
        $data=Kepmen050::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->update([
            'akun' => $request->akun,
            'kelompok' => $request->kelompok,
            'jenis' => $request->jenis,
            'objek' => $request->objek,
            'rincian_objek' => $request->rincian_objek,
            'subrincian_objek' => $request->subrincian_objek,
            'uraian' => $request->uraian,
        ]);

        return response()->json('Success');
    }

    public function delete(Request $request){

        $data=Kepmen050::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->delete();

        return response()->json('Success');
    }
}
