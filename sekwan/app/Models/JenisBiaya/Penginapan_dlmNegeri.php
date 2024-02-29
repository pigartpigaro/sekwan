<?php

namespace App\Models\JenisBiaya;

use App\Models\Master\Golongan;
use App\Models\Master\Provinsi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penginapan_dlmNegeri extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = 'penginapan_dlmnegeris';
    protected $dates = ['deleted_at'];

    public function provinsi(){
        return $this -> belongsTo(Provinsi::class);
    }
    public function golongan(){
        return $this -> belongsTo(Golongan::class);
    }
}
