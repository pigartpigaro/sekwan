<?php

namespace App\Models\Master;

use App\Models\Master\Kota_Kab;
use App\Models\Master\Provinsi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oneway extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'oneway';
    protected $timestamp = false;
    public function provinsi(){
        return $this -> belongsTo(Provinsi::class, 'provinsi_id', 'id');
    }
    public function kota(){
        return $this -> belongsTo(Kota_Kab::class, 'kota_kabs_id', 'id');
    }
}
