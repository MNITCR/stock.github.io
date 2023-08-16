<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PodetailModel;

class PodetaiController extends Controller
{
    public function getProdetail($poid)
    {
        $prodetail = PodetailModel::where('poid', $poid)->get();
        return response()->json(['data' => $prodetail]);
    }
}
