<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\JenisBiaya\JenisBiaya;
use App\Models\JenisBiaya\SemuaBiaya;
use App\Models\JenisBiaya\UH_PerdinLuarKota;
use App\Models\Master\Kepmen050;
use App\Models\Master\Kota_Kab;
use App\Models\Master\Provinsi;
use App\Models\Pelaksana\Dewan;
use App\Models\Transaksi\Trans_Header;
use App\Models\Transaksi\Trans_rinci;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Transaksi_PerdinController extends Controller
{
    public function index()
    {
        $perdin = Trans_Header::latest('id')
        ->with(['kepmen50','provinsi','kota','rinci'])
        ->when(request('q'), function ($query) {
            $query->where('no_transaksi', 'LIKE', '%' . request('q') . '%')
            ->orWhere('tanggal', 'LIKE', '%' . request('q') . '%')
            ->orWhere('judul', 'LIKE', '%' . request('q') . '%')
            ->orWhere('lamaperdin','LIKE', '%' . request('q') . '%')
            ;

        })->when(request('q'), function ($query) {
            $query->where('provinsi', 'LIKE', '%' . request('q') . '%');
        })->when(request('q'), function ($query) {
            $query->where('kota', 'LIKE', '%' . request('q') . '%');
        })
        ->paginate(request('per_page'));
        return new JsonResponse($perdin);
    }
    public function rinciall()
    {
        $perdin = Trans_rinci::where('header', request('id'))
        ->select('id','header',
                    'nik','golongan',
                    'tingkatan','jenis_biaya',
                    'jnskendaraan_id','tujuan_pesawat_id',
                    'kelas_pesawat','biaya',
                    'berapa_kali','total_biaya')
        ->with(['dewan'=>function($dewan){
            $dewan->with(['jabatan','golongan', 'tingkatan', 'komisi','flag_pegawai']);
        },'jenisbiaya'])

        ->get();
        return new JsonResponse($perdin);
    }
    public function rinci()
    {
        $perdin = Trans_rinci::where('header', request('id'))->where('jenis_biaya',request('jb'))
        ->select('id','header',
                    'nik','golongan',
                    'tingkatan','jenis_biaya',
                    'jnskendaraan_id','tujuan_pesawat_id',
                    'kelas_pesawat','biaya',
                    'berapa_kali','total_biaya')
        ->with(['dewan'=>function($dewan){
            $dewan->with(['jabatan','golongan', 'tingkatan', 'komisi','flag_pegawai']);
        },'jenisbiaya'])

        ->get();
        return new JsonResponse($perdin);
    }
    public function storeheader(Request $request)
    {
        if($request->id === '' || $request->id === null){
            $post = new Trans_Header();
            $post->no_transaksi = self::buatnomor();
            $post->tanggal = $request->tanggal;
            $post->lamaperdin = $request->lamaperdin;
            $post->judul = $request->judul;
            $post->provinsi = $request->id_propinsi;
            $post->kota = $request->id_kota;
           // $post->provinsi2 = $request->id_propinsi;
            $post->kota2 = $request->id_kota;
            $post->komisi = $request->komisi;
            $post->rekening50 = '5.1.02.04.01.0001';
            $post->uraian50 = 'Belanja Perjalanan Dinas Biasa';
            $post->save();
            $id = $post->id;

            if($post->save()){
                $rinci=Trans_Header::where('id','=', $id)->first();
                $rinci = new Trans_rinci();
                $rinci->id = $request->header;
                $rinci->nik = $request->nik;
                $rinci->jabatan = $request->jabatan;
                if('jabatan' !== null){
                    $rinci->biaya_representasi = 'representasi';
                    $rinci->biaya = 250000;
                    $rinci->berapa_kali = $request->kuantitas;
                    $rinci->total_biaya = $request->total_biaya;
                }
                $rinci->golongan = $request->golongan;
                $rinci->tingkatan = $request->tingkatan;
                $rinci->jenis_biaya = $request->id_jenistransaksi;
                $rinci->jnskendaraan_id = $request->id_jeniskendaraan;
                $rinci->tujuan_pesawat_id = $request->id_tujuanpesawat;
                $rinci->kelas_pesawat = $request->kelas;
                $rinci->biaya = $request->biaya;
                $rinci->berapa_kali = $request->kuantitas;
                $rinci->total_biaya = $request->total_biaya;
                $post->rinci()->save($rinci);

                // $tampil= Trans_rinci::where('id', '=', $id)
                //     ->with(['dewan','golongan', 'tingkatan' ,'jenisbiaya' ])
                //     ->get();

                return response()->json(['message' => 'Berhasil di Simpan', 'header' => $post, 'rinci' => $rinci ], 200);
            }else{
                return response()->json(['message' => 'Gagal di Simpan', 'data' => $post], 500);
            }
            // return response()->json(['message' => 'Berhasil di Simpan', 'data' => $post], 200);
            }else{
                $header=Trans_Header::where('id','=', $request->id)->first();
                $rinci = new Trans_rinci();
                $rinci->header = $request->id;
                $rinci->nik = $request->nik;
                $rinci->jabatan = $request->jabatan;
                if('jabatan' !== null){
                    $rinci->biaya_representasi = 'representasi';
                    $rinci->biaya = 250000;
                    $rinci->berapa_kali = $request->kuantitas;
                    $rinci->total_biaya = $request->total_biaya;
                }
                $rinci->golongan = $request->golongan;
                $rinci->tingkatan = $request->tingkatan;
                $rinci->jenis_biaya = $request->id_jenistransaksi;
                $rinci->jnskendaraan_id = $request->id_jeniskendaraan;
                $rinci->tujuan_pesawat_id = $request->id_tujuanpesawat;
                $rinci->kelas_pesawat = $request->kelas;
                $rinci->biaya = $request->biaya;
                $rinci->berapa_kali = $request->kuantitas;
                $rinci->total_biaya = $request->total_biaya;
                $rinci->save();

                return response()->json(['message' => 'Berhasil di Simpan', 'rinci' => $rinci, 'header' => $header ],200);

        }
    }


    public function hapusperdin(Request $request)
    {
        $rinci = Trans_rinci::select('header')->where('id', $request->id);
        if (!$rinci) {
            return new JsonResponse(['message' => 'Maaf Data Tidak Ditemukan'], 501);
        }
        $hapus = $rinci->delete();

        if (!$hapus) {
            return new JsonResponse(['message' => 'gagal dihapus'], 500);
        }

        return new JsonResponse(['message' => 'berhasil dihapus', 'header' => $rinci], 200);
    }


    public static function buatnomor(){
        $huruf = ('SPM-PERDIN');
        $no = ('4.02.0.00.0.00.01.0000');
        date_default_timezone_set('Asia/Jakarta');
        // $tgl = date('Y/m/d');
        $thn = date('Y');
        $rom = array('','I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII');
        // $time = date('mis');
        // $nomer=Transaksi::latest();
        $cek = Trans_Header::count();
        if ($cek == null){
            $urut = "0001";
            $sambung = $urut.'/'.strtoupper($no).'/'.strtoupper($huruf).'/'.$rom[date('n')].'/'.$thn;
        }
        else{
            $ambil=Trans_Header::all()->last();
            $urut = (int)substr($ambil->no_transaksi, 0, 4) + 1;
            //cara menyambungkan antara tgl dn kata dihubungkan tnda .
            // $urut = "000" . $urut;
            if(strlen($urut) == 1){
                $urut = "000" . $urut;
            }
            else if(strlen($urut) == 2){
                $urut = "00" . $urut;
            }
            else if(strlen($urut) == 3){
                $urut = "0" . $urut;
            }
            else {
                $urut = (int)$urut;
            }
            $sambung = $urut.'/'.strtoupper($no).'/'.strtoupper($huruf).'/'.$rom[date('n')].'/'.$thn;
        }

        return $sambung;
    }
    public static function buattanggal(){
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');
        return $tanggal;

    }
}
