<?php

namespace App\Models\Master;

use App\Models\JenisBiaya\UH_PerdinLuarKota;
use App\Models\Master\Provinsi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tingkatan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'tingkatans';

    public function provinsi (){
        return $this->hasMany(Provinsi::class);
    }
    public function uh (){
        return $this->belongsTo(UH_PerdinLuarKota::class);
    }
}
