<?php

namespace App\Models\JenisBiaya;

use App\Models\Master\Provinsi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'taksis';
    protected $timestamp = false;
    public function provinsi(){
        return $this -> belongsTo(Provinsi::class, 'provinsi', 'name');
    }
}
