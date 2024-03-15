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
    protected $table = 'uangharians';

    protected $timestamp = false;

    public function provinsi(){
        return $this -> belongsTo(Provinsi::class, 'provinsi_id', 'id');
    }
    public function tingkatan(){
        return $this -> belongsTo(Tingkatan::class, 'tingkatan_id', 'id');
    }
}
