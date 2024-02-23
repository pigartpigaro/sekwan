<?php

namespace App\Models\JenisBiaya;

use App\Models\Master\Provinsi;
use App\Models\Master\Tingkatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UH_PerdinLuarKota extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'uh_perdinluarkotas';

    public function provinsi(){
        return $this -> hasMany(Provinsi::class);
    }
    public function tingakatan(){
        return $this -> hasMany(Tingkatan::class);
    }
}
