<?php

namespace App\Models\JenisBiaya;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBiaya extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'jenisbiaya';
    protected $timestamp = false;
}
