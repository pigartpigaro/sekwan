<?php

namespace App\Models\Transaksi;

use App\Models\JenisBiaya\UH_PerdinLuarKota;
use App\Models\Pelaksana\Dewan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi_Perdin extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'transaksi_perdins';
    protected $timestamp = false;

    public function dewan(){
        return $this->hasMany(Dewan::class,'nama', 'nama');
    }
    public function perdin(){
        return $this->hasMany(UH_PerdinLuarKota::class,'nama', 'name');
    }
}
