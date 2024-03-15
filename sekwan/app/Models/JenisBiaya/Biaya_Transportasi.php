<?php

namespace App\Models\JenisBiaya;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya_Transportasi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'transportasis';

    protected $timestamp = false;
}
