<?php

namespace App\Models\Master;

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
    public function satuan (){
        return $this->belongsTo(Satuan::class);
    }
}
