<?php

namespace App\Models\JenisBiaya;

use App\Models\Master\Provinsi;
use App\Models\Master\Tingkatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UH_PerdinLuarKota extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = 'uangharians';
    protected $dates = ['deleted_at'];

    public function provinsi(){
        return $this -> belongsTo(Provinsi::class);
    }
    public function tingakatan(){
        return $this -> belongsTo(Tingkatan::class);
    }
}
