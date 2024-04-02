<?php

namespace App\Models\Transaksi;

use App\Models\JenisBiaya\Biaya_Transportasi;
use App\Models\JenisBiaya\JenisBiaya;
use App\Models\JenisBiaya\Penginapan;
use App\Models\JenisBiaya\Pesawat;
use App\Models\JenisBiaya\Taksi;
use App\Models\JenisBiaya\UH_PerdinLuarKota;
use App\Models\Master\Golongan;
use App\Models\Master\Kendaraan;
use App\Models\Pelaksana\Dewan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Transport\Transport;

class Trans_rinci extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'transaksi_rincis';
    protected $timestamp = false;
    public function header(){
        return $this->belongsTo(Trans_Header::class, 'header', 'id');
    }
    // public function uangharian (){
    //     return $this->belongsTo(UH_PerdinLuarKota::class, 'uangharian', 'id');
    // }
    // public function penginapan (){
    //     return $this->belongsTo(Penginapan::class, 'penginapan', 'id');
    // }
    // public function transportasi (){
    //     return $this->belongsTo(Biaya_Transportasi::class, 'transportasi', 'id');
    // }
    public function pesawat (){
        return $this->belongsTo(Pesawat::class, 'tujuan_pesawat_id', 'id');
    }
    public function dewan (){
        return $this->hasMany(Dewan::class, 'nik', 'nik');
    }
    public function golongan (){
        return $this->hasMany(Golongan::class, 'id', 'golongan');
    }
    public function tingkatan (){
        return $this->hasMany(Golongan::class, 'id', 'tingkatan');
    }
    public function jenisbiaya (){
        return $this->hasMany(JenisBiaya::class, 'id', 'jenis_biaya');
    }
    public function kendaraan (){
        return $this->hasMany(Kendaraan::class, 'id', 'jnskendaraan_id');
    }
    public function uangharian (){
        return $this->hasMany(UH_PerdinLuarKota::class, 'biaya', 'biaya');
    }
    public function penginapan (){
        return $this->hasMany(Penginapan::class, 'biaya', 'biaya');
    }
}
