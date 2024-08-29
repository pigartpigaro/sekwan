<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Transaksi\Trans_Header;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetperdinbynospjController extends Controller
{
    public function getperdinbynospj()
    {
        $data = Trans_Header::with(
            [
                'rinci'
            ]
        )
        ->where('no_transaksi', request('nospj'))
        ->get();

        return new JsonResponse($data);
    }
}
