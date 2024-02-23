<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota_Kab extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'kota_kabs';
}
