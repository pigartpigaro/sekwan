<?php

namespace App\Models\JenisBiaya;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBiaya extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'jenisbiaya';
    protected $timestamp = false;
    // public function uangharian (){
    //     return $this->hasMany(UH_PerdinLuarKota::class, 'jnsbiaya', 'name');
    // }
    // public function penginapan (){
    //     return $this->hasMany(Penginapan::class, 'jnsbiaya', 'name');
    // }
    // public function transportasi (){
    //     return $this->hasMany(Biaya_Transportasi::class, 'jnsbiaya', 'name');
    // }
    // public function pesawat (){
    //     return $this->hasMany(Pesawat::class, 'jnsbiaya', 'name');
    // }
    // public function taksi (){
    //     return $this->hasMany(Taksi::class, 'jnsbiaya', 'name');
    // }
}
