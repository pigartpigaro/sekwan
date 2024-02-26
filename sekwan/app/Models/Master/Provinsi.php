<?php

namespace App\Models\Master;

use App\Models\JenisBiaya\Penginapan_dlmNegeri;
use App\Models\JenisBiaya\UH_PerdinLuarKota;
use App\Models\Master\Tingkatan;
use App\Models\Master\Golongan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'provinsis';

    public function tingkatan (){
        return $this->hasMany(Tingkatan::class);
    }
    public function golongan (){
        return $this->hasMany(Golongan::class);
    }
    public function uh (){
        return $this->belongsTo(UH_PerdinLuarKota::class);
    }
    public function penginapan (){
        return $this->belongsTo(Penginapan_dlmNegeri::class);
    }
}
