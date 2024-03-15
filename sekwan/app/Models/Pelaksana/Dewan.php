<?php

namespace App\Models\Pelaksana;

use App\Models\JenisBiaya\UH_PerdinLuarKota;
use App\Models\Master\Golongan;
use App\Models\Master\Tingkatan;
use App\Models\Pelaksana\Jabatan;
use App\Models\Pelaksana\Komisi;
use App\Models\Pelaksana\Flag_Pegawai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dewan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'dewans';
    protected $timestamp = false;

    public function jabatan (){
        return $this->belongsTo(Jabatan::class,'id_jabatan', 'id');
    }
    public function komisi (){
        return $this->belongsTo(Komisi::class,'id_komisi', 'id');
    }
    public function tingkatan (){
        return $this->belongsTo(Tingkatan::class,'tingkatan_id', 'id');
    }
    public function golongan (){
        return $this->belongsTo(Golongan::class,'golongan_id', 'id');
    }

    public function flag_pegawai (){
        return $this->belongsTo(Flag_Pegawai::class,'id_flag_pegawai', 'id');
    }

    public function perdin(){
        return $this->hasMany(UH_PerdinLuarKota::class,'name', 'nama');
    }
    // const STATUS_ACTIVE    = 1;
    // const STATUS_SUSPENDED = 2;
    // const STATUS_INACTIVE  = 3;

    // /**
    //  * Return list of status codes and labels

    //  * @return array
    //  */
    // public static function listStatus()
    // {
    //     return [
    //         self::STATUS_ACTIVE    => 'Active',
    //         self::STATUS_SUSPENDED => 'Suspended',
    //         self::STATUS_INACTIVE  => 'Inactive'
    //     ];
    // }

    // /**
    //  * Returns label of actual status

    //  * @param string
    //  */
    // public function statusLabel()
    // {
    //     $list = self::listStatus();

    //     // little validation here just in case someone mess things
    //     // up and there's a ghost status saved in DB
    //     return isset($list[$this->status])
    //         ? $list[$this->status]
    //         : $this->status;
    // }
}
