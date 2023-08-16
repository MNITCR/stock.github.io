<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoModelAPI;

class PoControllerAPI extends Controller
    {
        public function SearchAPI(Request $rq) {
            $formdate = $rq->input('fromdate');
            $todate = $rq->input('todate');
            return PoModelAPI::where('date', '>=', $formdate)->where('date', '<=', $todate)->get();
        }
        
        // public function SearchAPI(Request $rq){
        //     $formdate = $rq->fromdate;
        //     $todate = $rq->todate;
        //     // select query
        //     // return PoModelAPI::get();
        //     return PoModelAPI::where('date', '>=', $formdate)->where('date', '<=', $todate)->get();

    }
