<?php

namespace App\Models\JenisBiaya;

use App\Models\Master\Kota_Kab;
use App\Models\Master\Provinsi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya_Transportasi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'transportasis';
    protected $timestamp = false;
    public function provinsi(){
        return $this -> belongsTo(Provinsi::class, 'provinsi', 'name');
    }
    public function kota(){
        return $this -> belongsTo(Kota_Kab::class, 'kota', 'name');
    }
}
