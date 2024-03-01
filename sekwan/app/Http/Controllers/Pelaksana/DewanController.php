<?php

namespace App\Http\Controllers\Pelaksana;

use App\Http\Controllers\Controller;
use App\Models\Pelaksana\Dewan;
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
                if ($status === '') {
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
            ->paginate(10);
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
        $data = Dewan::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'jns_kelamin' => $request->jns_kelamin,
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'komisi' => $request->komisi,
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
            'nama' => $request->nama,
            'nik' => $request->nik,
            'jns_kelamin' => $request->jns_kelamin,
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'komisi' => $request->komisi,
        ]);

        return response()->json('Sukses Updated');
    }

    public function delete(Request $request)
    {

        $data = Dewan::find($request->id);
        if (!$data) {
            return response()->json('NotValid', 500);
        }
        $data->delete();

        return response()->json('Success');
    }
    public function status($id)
    {
        $data = Dewan::where('id', $id)->first();

        $aktif = $data->status;

        if ($aktif == 1) {
            Dewan::where('id', $id)->update([
                'status' => 0
            ]);
        } else {
            Dewan::where('id', $id)->update([
                'status' => 1
            ]);
        }
        return response()->json('Success', 'Status Berhasil Ganti');

        // $dewan = Dewan::find($id);
        // $dewan->status = $id->status;
        // $dewan->save();

        // return response()->json('Success','Status change successfully');

    }
}
