<?php

namespace App\Models\Master;

use App\Models\Transaksi\Trans_Header;
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
    public function header (){
        return $this->hasOne(Trans_Header::class, 'rekening50', 'kodeall');
    }
}
