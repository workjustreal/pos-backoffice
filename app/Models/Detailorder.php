<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailorder extends Model
{
    use HasFactory;
    protected $table = 'pos_order_detail';
    protected $fillable = ['id','order_id','sku','name','qty','price','total_price','status','created_at','updated_at'];
}
