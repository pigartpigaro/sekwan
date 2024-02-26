<?php

namespace App\Models\Pelaksana;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dewan extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $table = 'dewans';

    protected $dates = ['deleted_at'];

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
