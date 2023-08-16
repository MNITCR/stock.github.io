<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productlist;
use App\Models\PurchaseModel;
use App\Models\PodetailModel;

class PurchaseController extends Controller
{
    public function index(){
        return view('purchase.Purchase');
    }

    // search
    public function SearchProduct(Request $rq){
        $code = $rq->barcode;
        $result = productlist::where('barcode', $code)->first();
        if(isset($result)){
            $proid = $result->proid;
            $proname = $result->title;
            echo $proid. ";". $proname;
        }else{
            echo 0;
        }
    }

    // create
    public function create(Request $rq){
        $proid = $rq->prid;
        $qty = $rq->qty;
        $cost = $rq->cost;
        $barcode = $rq->pocode;
        $date = $rq->date;
        $discount = $rq->dis;
        $tax = $rq->tax;
        $total = $rq->total;
        $total_grand = $rq->grand_total;
        // echo $proid;
        // echo $barcode.$date.$tax.$total.$discount;
        $id = PurchaseModel::insertGetId(
                [
                    'pocode' => $barcode,
                    'date' => $date,
                    'tax' => $tax,
                    'dis' => $discount,
                    'total' => $total,
                    'grand_total' => $total_grand
                ]
            );
        $poid = $id;
        // echo $proid;
        $data = array();
        for($i = 0; $i < count($proid); $i++){
            $data = array('poid'=>$poid,'proid'=>$proid[$i],'qty'=>$qty[$i],'cost'=>$cost[$i]);
            PodetailModel::insert($data);
        }
    }
}
