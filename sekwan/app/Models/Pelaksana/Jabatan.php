<?php

namespace App\Models\Pelaksana;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'jabatans';

    // public function dewan (){
    //     return $this->hasMany(Dewan::class);
    // }
}
