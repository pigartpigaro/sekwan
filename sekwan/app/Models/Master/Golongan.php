<?php

namespace App\Models\Master;

use App\Models\JenisBiaya\Penginapan_dlmNegeri;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'golongans';

    public function provinsi (){
        return $this->hasMany(Provinsi::class);
    }
    public function penginapan (){
        return $this->belongsTo(Penginapan_dlmNegeri::class);
    }
}
