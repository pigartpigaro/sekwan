<?php

namespace App\Http\Controllers\Pelaksana;

use App\Http\Controllers\Controller;
use App\Models\Pelaksana\Komisi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KomisiController extends Controller
{
    public function index(){
        // $data=Komisi::latest()
        $status = request('status') ?? '';
        $data = Komisi::where(function ($sts) use ($status) {
            if ($status !== 'all') {
                if ($status === '') {
                    $sts->where('status', '!=', '1');
                } else {
                    $sts->where('status', '=', $status);
                }
            }
        })->where(function ($query) {
            $query->where('komisi', 'LIKE', '%' . request('q') . '%');
        })
        ->paginate('per_page');
        return response()->json($data);
    }

    public function store(Request $request){
        $data=Komisi::create([
            'komisi'=> $request->komisi,
            'flag_pegawai'=> $request->flag_pegawai,
        ]);

        return new JsonResponse(['message' => 'Berhasil di Simoan', 'data' => $data], 200);
    }
    public function update(Request $request){
        $data=Komisi::find($request->id);
        if(!$data){
            return new JsonResponse(['message' => 'Gagal Update', 'data' => $data], 200);
        }
        $data->update([
            'komisi'=> $request->komisi,
            'flag_pegawai'=> $request->flag_pegawai,
        ]);

        return new JsonResponse(['message' => 'Berhasil di Update', 'data' => $data], 200);
    }

    public function delete(Request $request){

        $data=Komisi::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->delete();

        return response()->json('Success');
    }

    public function status(Request $request)
    {
        $data = Komisi::find($request->id);
        $data->update(['flag_pegawai' => $request->flag_pegawai]);

        if ($data->wasChanged()) {
            return new JsonResponse(['message' => 'Status sudah diganti', 'data' => $data], 201);
        }
        return new JsonResponse(['message' => 'Status pegawai tetap'], 200);
    }
}
