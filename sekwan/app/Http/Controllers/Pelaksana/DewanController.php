<?php

namespace App\Http\Controllers\Pelaksana;

use App\Http\Controllers\Controller;
use App\Models\Pelaksana\Dewan;
use App\Models\Pelaksana\Flag_Pegawai;
use App\Models\Pelaksana\Jabatan;
use App\Models\Pelaksana\Komisi;
use App\Models\Transaksi\Trans_rinci;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DewanController extends Controller
{
    public function index()
    {

        $status = request('status') ?? '';
        $pegawai =[1, 2];
        $data = Dewan::with(['jabatan', 'komisi', 'flag_pegawai', 'tingkatan', 'golongan'])

        ->where(function ($sts) use ($status) {

            if ($status === '') {
                $sts->where('status', '!=', '1');
            } else {
                $sts->where('status', '=', $status);
            }
        })
        ->whereIn('id_flag_pegawai', $pegawai)
        ->when(request('id_flag_pegawai'), function ($query){
            $query->where('id_flag_pegawai', request('id_flag_pegawai'))
            ;
        })
        ->when(request('komisi_id'), function ($query) {
            $query->where('id_komisi', request('komisi_id'));
        })
        ->when(request('q'), function ($query) {
            $query->where('nama', 'LIKE', '%' . request('q') . '%')
            ->orWhere('nik', 'LIKE', '%' . request('q') . '%');
        })

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
        // $pegawai = Flag_Pegawai::where('id','=',$request->id_flag_pegawai)->first();
        // if(!$komisi){
        //     return new JsonResponse(['message' => 'data komisi tidak ditemukan', 'data' => $pegawai], 501);
        // }
        $data = Dewan::create([
            'nama'         => $request->nama,
            'nik'          => $request->nik,
            'jns_kelamin'  => $request->jns_kelamin,
            'alamat'       => $request->alamat,
            'id_jabatan'   => $request->id_jabatan,
            'golongan_id'   => $request->golongan_id,
            'tingkatan_id'   => $request->tingkatan_id,
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
            'golongan_id'   => $request->golongan_id,
            'tingkatan_id'   => $request->tingkatan_id,
            'id_komisi'   => $request->id_komisi,
            'id_flag_pegawai' => $request->id_flag_pegawai,

        ]);

        return new JsonResponse(['message' => 'Berhasil di Update', 'data' => $data], 200);
    }

    public function delete(Request $request)
    {
        $trans = Trans_rinci::where('dewan', '=', '');
        $cari = Dewan::find($request->id);
        if (!$cari) {
            return new JsonResponse(['message' => 'data tidak ditemukan'], 501);
        }
        $cari->delete();
        // $hapus = $cari->flag;
        // if ($hapus !== 1) {
        // $hapus = $cari->update([
        //     'flag'  => 1,
        // ]);
        // if (!$hapus) {
        //     return new JsonResponse(['message' => 'gagal dihapus'], 501);
        // }
        return new JsonResponse(['message' => 'berhasil dihapus'], 200);

    }
    public function status(Request $request)
    {
        $cari = Dewan::find($request->id);
        // if (!$cari) {
        //     return new JsonResponse(['message' => 'data tidak ditemukan'], 501);
        // }
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
