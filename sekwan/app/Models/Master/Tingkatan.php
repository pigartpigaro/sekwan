<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tingkatan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'tingkatans';

    public function provinsi (){
        return $this->hasMany(Provinsi::class);
    }
}
