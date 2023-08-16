<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Overview extends Controller
{
    public function ShowGraph(Request $rq){

        $select_data = $rq->input('selected_table');

        if($select_data === 'product'){
            $item = ProductModel::all();
        }elseif($select_data === 'book'){
            $item = CategoryModel::all();
        }else{
            $item = ProductModel::all();
        }

        // $item = ProductModel::all();
        $data = [
            'labels' => $item->pluck('title')->toArray(),
            'quantities' => $item->pluck('qty')->toArray()
        ];
        return view('admin.overview', compact('data'));
    }

    public function dashboard(Request $rq){

        $item = ProductModel::all();

        // $item = ProductModel::all();
        $data = [
            'labels' => $item->pluck('title')->toArray(),
            'quantities' => $item->pluck('qty')->toArray()
        ];
        return view('admin.dashboard', compact('data'));
    }
}
