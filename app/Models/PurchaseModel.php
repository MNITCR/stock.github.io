<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseModel extends Model
{
    use HasFactory;
    protected $table = 'tblpo';
    protected $primaryKey = 'poid';
    protected $fillable = ['pocode', 'dis', 'tax', 'total', 'grand_total', 'date'];
}
