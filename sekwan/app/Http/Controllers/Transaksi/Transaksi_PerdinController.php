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

class Transaksi_PerdinController extends Controller
{
    // public function header(){
    //     $perdin = Trans_Header::where('id', '=', request()->id)->latest('id')
    //     ->with(['kepmen50','provinsi'=>function($prov){
    //         $prov->with(['kota','uangharian'=>function($uh){
    //             $uh->with(['tingkatan']);
    //         },'penginapan'=>function($inap){
    //             $inap->with(['golongan']);
    //         }])->select('id');
    //     }])

    //     // $perdin = Trans_Header::where('id', '=', request()->id)->latest('id')
    //     // ->with(['kepmen50','provinsi'=>function($prov){
    //     //     $prov->with(['kota'])->select('id');
    //     // },'rinci'=>function($rinci){
    //     //     $rinci->with(['uangharian','penginapan','dewan'])->select('id');
    //     // }])
    //     ->paginate(request('per_page'));
    //     return new JsonResponse($perdin);
    // }
    public function index()
    {

        $perdin = Trans_Header::latest('id')
        ->with(['kepmen50','provinsi','kota','rinci'=>function($rinci){
            $rinci->with(['uangharian'=>function($uh){
                $uh->with(['tingkatan']);
            },'penginapan'=>function($inap){
                $inap->with(['provinsi','golongan']);
            },'transportasi'=>function($trans){
                $trans->with(['provinsi','kota']);
            },'pesawat','taksi'=>function($taksi){
                $taksi->with(['provinsi']);
            },'dewan']);
        }])
        ->paginate(request('per_page'));
        return new JsonResponse($perdin);
    }
    public function storeheader(Request $request)
    {
        $post = new Trans_Header();
        $post->no_transaksi = self::buatnomor();
        // $post->tanggal = self::buattanggal();
        $post->tanggal = $request->date('Y/m/d');
        $post->lamaperdin = $request->lamaperdin;
        $post->judul = $request->judul;
        $post->provinsi = $request->provinsi;
        $post->kota = $request->kota;
        $post->rekening50 = $request->rekening50;
        // $post->uraian50 = $request->uraian50;
        $post->save();

        return response()->json(['message' => 'Berhasil di Simpan', 'data' => $post], 200);
    }

    public function storerinci(Request $request)
    {

        $post = new Trans_rinci();
        $post->fill($request->all());
        $post->save();

        return response()->json(['message' => 'Berhasil di Simpan', 'data' => $post], 200);
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
