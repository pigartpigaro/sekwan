<?php

namespace App\Models\Transaksi;

use App\Models\JenisBiaya\Biaya_Transportasi;
use App\Models\JenisBiaya\Penginapan;
use App\Models\JenisBiaya\Pesawat;
use App\Models\JenisBiaya\Taksi;
use App\Models\JenisBiaya\UH_PerdinLuarKota;
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
    public function uangharian (){
        return $this->hasMany(UH_PerdinLuarKota::class, 'id', 'uangharian');
    }
    public function penginapan (){
        return $this->hasMany(Penginapan::class, 'id', 'penginapan');
    }
    public function transportasi (){
        return $this->hasMany(Biaya_Transportasi::class, 'id', 'transportasi');
    }
    public function pesawat (){
        return $this->hasMany(Pesawat::class, 'tujuan', 'pesawat');
    }
    public function taksi (){
        return $this->hasMany(Taksi::class, 'provinsi', 'taksi');
    }
    public function dewan (){
        return $this->hasMany(Dewan::class, 'id', 'dewan');
    }
}
