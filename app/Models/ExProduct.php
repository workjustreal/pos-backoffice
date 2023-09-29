<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExProduct extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'ex_product';
    protected $fillable = [
        'stkcod',
        'barcod',
        'names',
        'sellpr1',
    ];
}