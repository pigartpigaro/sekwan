<?php

namespace App\Models\Transaksi;

use App\Models\JenisBiaya\JenisBiaya;
use App\Models\JenisBiaya\SemuaBiaya;
use App\Models\JenisBiaya\UH_PerdinLuarKota;
use App\Models\Master\Kepmen050;
use App\Models\Master\Kota_Kab;
use App\Models\Master\Provinsi;
use App\Models\Pelaksana\Dewan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trans_Header extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'transaksi_headers';
    protected $timestamp = false;
    public function kepmen50(){
        return $this->belongsTo(Kepmen050::class,'kepmen050', 'id');
    }
    public function provinsi(){
        return $this->belongsTo(Provinsi::class,'provinsi', 'name');
    }
    public function kota(){
        return $this->belongsTo(Kota_Kab::class,'kota', 'name');
    }

    // public function jnsbiaya(){
    //     return $this->belongsTo(JenisBiaya::class,'jenisbiaya', 'id');
    // }
    // public function biaya(){
    //     return $this->hasMany(SemuaBiaya::class,'id', 'semuabiaya_id');
    // }
    // public function dewan(){
    //     return $this->hasMany(Dewan::class,'id', 'dewan_id');
    // }

}
