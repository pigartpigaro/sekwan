<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepmen050 extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'kepmen050s';
    protected $appends = ['kodeall'];
    public function getKodeallAttribute(){
        return "{$this->akun}.{$this->kelompok}.{$this->jenis}.{$this->objek}.{$this->rincian_objek}.{$this->subrincian_objek}";
    }
}
