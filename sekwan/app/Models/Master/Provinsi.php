<?php

namespace App\Models\Master;

use App\Models\JenisBiaya\Penginapan;
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

    public function uangharian (){
        return $this->hasMany(UH_PerdinLuarKota::class, 'provinsi_id', 'id');
    }
    public function penginapan (){
        return $this->hasMany(Penginapan::class, 'provinsi_id', 'id');
    }
    public function kota (){
        return $this->hasMany(Kota_Kab::class, 'provinsi_id', 'id');
    }
}
