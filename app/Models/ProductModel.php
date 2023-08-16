<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'tblproduct';
    // protected $table1 = 'product_list';
    protected $primaryKey = 'proid';
    protected $fillable = ['barcode', 'title', 'qty', 'price','categoryid'];
    // protected $fillable = ['barcode', 'protitle', 'qty', 'price','catid'];
}
