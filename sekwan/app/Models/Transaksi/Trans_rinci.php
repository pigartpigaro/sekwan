<?php

namespace App\Models\Transaksi;

use App\Models\JenisBiaya\Penginapan;
use App\Models\JenisBiaya\UH_PerdinLuarKota;
use App\Models\Pelaksana\Dewan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function dewan (){
        return $this->hasMany(Dewan::class, 'id', 'dewan');
    }
}
