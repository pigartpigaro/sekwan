<?php

namespace App\Models\JenisBiaya;

use App\Models\Master\Golongan;
use App\Models\Master\Provinsi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penginapan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'penginapans';
    protected $timestamp = false;

    public function provinsi(){
        return $this -> belongsTo(Provinsi::class, 'provinsi_id', 'id');
    }
    public function golongan(){
        return $this -> belongsTo(Golongan::class, 'golongan_id', 'id');
    }
}
