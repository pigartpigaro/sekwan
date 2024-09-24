<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Pejabat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PejabatController extends Controller
{
    public function pejabat()
    {
        $data = Pejabat::get();
        return new JsonResponse($data);
    }
}
