<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{
    use HasFactory;
    protected $table = 'product_log';
    protected $fillable = ['id', 'barcode', 'emp_id', 'price_before', 'price_after', 'created_at', 'updated_at'];
}
