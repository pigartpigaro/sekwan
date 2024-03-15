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
    public function index(){
        $perdin = Trans_rinci::latest('id')
        ->with(['header'=>function($header){
            $header->with(['kepmen50','provinsi'=>function($prov){
                $prov->with(['kota']);
            },'kota']);
        },'uangharian'=>function($uh){
            $uh->with(['tingkatan']);
        },'penginapan'=>function($inap){
            $inap->with(['golongan']);
        },'dewan'])
        ->paginate(request('per_page'));
        return new JsonResponse($perdin);
    }
    public function storeheader(Request $request)
    {
        $post = new Trans_Header();
        $post->fill($request->all());
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
}
