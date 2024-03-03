<?php

namespace App\Models\Pelaksana;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komisi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'komisis';
    // public function dewan (){
    //     return $this->hasMany(Dewan::class);
    // }
}
