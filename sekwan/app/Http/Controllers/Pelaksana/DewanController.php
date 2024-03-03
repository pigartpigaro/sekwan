<?php

namespace App\Http\Controllers\Pelaksana;

use App\Http\Controllers\Controller;
use App\Models\Pelaksana\Dewan;
use App\Models\Pelaksana\Flag_Pegawai;
use App\Models\Pelaksana\Jabatan;
use App\Models\Pelaksana\Komisi;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DewanController extends Controller
{
    public function index(Request $request)
    {
        // $data=Dewan::get();
        // $data = DB::table('dewans')->select('id','nama','nik', 'komisi')->get();
        // $data = DB::table('dewans')->whereIn('status', [0, 1])->get();
        $status = request('status') ?? '';
        // $data = Dewan::whereIn('status', $status)
        //     ->where(function ($query) {
        //         $query->where('nama', 'LIKE', '%' . request('q') . '%')
        //             ->orWhere('nik', 'LIKE', '%' . request('q') . '%');
        //     })
        //     ->paginate(10);

        $data = Dewan::where(function ($sts) use ($status) {
            if ($status !== 'all') {
                if ($status === '0') {
                    $sts->where('status', '!=', '1');
                } else {
                    $sts->where('status', '=', $status);
                }
            }
        })
            ->where(function ($query) {
                $query->where('nama', 'LIKE', '%' . request('q') . '%')
                    ->orWhere('nik', 'LIKE', '%' . request('q') . '%');
            })
            // ->with(['jabatans', 'komisis'])
            ->paginate(request('per_page'));
        return response()->json($data);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nik'  => 'required|unique:dewans',
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json(['message' => 'NIK Sudah Tersedia', 'data' => $validator], 422);
        }
        // $jabatan = Jabatan::where('id','=',$request->id_jabatan)->first();
        // if(!$jabatan){
        //     return new JsonResponse(['message' => 'data jabatan tidak ditemukan', 'data' => $jabatan], 501);
        // }
        // $komisi = Komisi::where('id','=',$request->id_komisi)->first();
        // if(!$komisi){
        //     return new JsonResponse(['message' => 'data komisi tidak ditemukan', 'data' => $komisi], 501);
        // }
        // $pegawai = Flag_Pegawai::where('id','=',$request->id_komisi)->first();
        // if(!$komisi){
        //     return new JsonResponse(['message' => 'data komisi tidak ditemukan', 'data' => $pegawai], 501);
        // }
        $data = Dewan::create([
            'nama'         => $request->nama,
            'nik'          => $request->nik,
            'jns_kelamin'  => $request->jns_kelamin,
            'alamat'       => $request->alamat,
            'id_jabatan'   => $request->id_jabatan,
            'id_komisi'    => $request->id_komisi,
            'id_flag_pegawai' => $request->id_flag_pegawai,

        ]);

        return response()->json(['message' => 'Berhasil di Simpan', 'data' => $data], 200);
    }
    public function update(Request $request)
    {
        $data = Dewan::find($request->id);
        if (!$data) {
            return response()->json('NotValid', 500);
        }

        $data->update([
            'nama'        => $request->nama,
            'nik'         => $request->nik,
            'jns_kelamin' => $request->jns_kelamin,
            'alamat'      => $request->alamat,
            'id_jabatan'  => $request->id_jabatan,
            'id_komisi'   => $request->id_komisi,
            'id_flag_pegawai' => $request->id_flag_pegawai,

        ]);

        return new JsonResponse(['message' => 'Berhasil di Update', 'data' => $data], 200);
    }

    public function delete(Request $request)
    {

        // $data = Dewan::find($request->id);
        // if (!$data) {
        //     return response()->json('NotValid', 500);
        // }
        // $data->delete()->update([
        //     'hide' => 1
        // ]);

        // return response()->json('Success');
        $cari = Dewan::find($request->id);
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
    public function status(Request $request)
    {
        // $data = Dewan::where('id', $id)->first();

        // $aktif = $data->status;

        // if ($aktif == 1) {
        //     Dewan::where('id', $id)->update([
        //         'status' => 0
        //     ]);
        // } else {
        //     Dewan::where('id', $id)->update([
        //         'status' => 1
        //     ]);
        // }

        // return response()->json('Success', 'Status Berhasil Ganti');

        $cari = Dewan::find($request->id);
        if (!$cari) {
            return new JsonResponse(['message' => 'data tidak ditemukan'], 501);
        }
        $ganti = $cari->status;
        if ($ganti !== 1) {
        $ganti = $cari->update([
            'status'  => 1,
        ]);
        if (!$ganti) {
            return new JsonResponse(['message' => 'gagal diupdate'], 501);
        }
        return new JsonResponse(['message' => 'berhasil diupdate'], 200);
        }

    }
}
