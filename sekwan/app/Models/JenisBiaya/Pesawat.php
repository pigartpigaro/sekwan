<?php

namespace App\Models\JenisBiaya;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesawat extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pesawats';

    protected $timestamp = false;
}
