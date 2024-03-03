<?php

namespace App\Http\Controllers\Pelaksana;

use App\Http\Controllers\Controller;
use App\Models\Pelaksana\Komisi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KomisiController extends Controller
{
    public function index(){
        $flag = request('flag') ?? '';
        $data = Komisi::where(function ($sts) use ($flag) {
            if ($flag === '') {
                $sts->where('flag', '!=', '1');
            } else {
                $sts->where('flag', '=', $flag);
            }

        })
            ->where(function ($query) {
                $query->where('komisi', 'LIKE', '%' . request('q') . '%');
            })
            ->paginate(request('per_page'));
        return response()->json($data);
    }

    public function store(Request $request){
        $data=Komisi::create([
            'komisi'=> $request->komisi,

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

        ]);

        return new JsonResponse(['message' => 'Berhasil di Update', 'data' => $data], 200);
    }

    public function delete(Request $request)
    {

        // $data = Komisi::find($request->id);
        // if (!$data) {
        //     return response()->json('NotValid', 500);
        // }
        // $data->delete()->update([
        //     'hide' => 1
        // ]);

        // return response()->json('Success');
        $cari = Komisi::find($request->id);
        if (!$cari) {
            return new JsonResponse(['message' => 'data tidak ditemukan'], 501);
        }
        $hapus = $cari->flag;
        if ($hapus !== 1) {
        $hapus = $cari->update([
            'flag'  => 1,
        ]);
        if (!$hapus) {
            return new JsonResponse(['message' => 'gagal dihapus'], 501);
        }
        return new JsonResponse(['message' => 'berhasil dihapus'], 200);
        }
    }

}
