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
        return $this->belongsTo(UH_PerdinLuarKota::class, 'uangharian', 'id');
    }
    public function penginapan (){
        return $this->belongsTo(Penginapan::class, 'penginapan', 'id');
    }
    public function transportasi (){
        return $this->belongsTo(Biaya_Transportasi::class, 'transportasi', 'id');
    }
    public function pesawat (){
        return $this->belongsTo(Pesawat::class, 'pesawat', 'id');
    }
    public function taksi (){
        return $this->belongsTo(Taksi::class, 'taksi', 'id');
    }
    public function dewan (){
        return $this->belongsTo(Dewan::class, 'nik', 'id');
    }
}
