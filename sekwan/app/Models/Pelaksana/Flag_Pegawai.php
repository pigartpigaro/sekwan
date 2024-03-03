<?php

namespace App\Models\Pelaksana;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flag_Pegawai extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'flag_pegawais';

    public function dewan (){
        return $this->hasMany(Dewan::class);
    }
}
