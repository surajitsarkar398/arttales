<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'register_id',
        'store_id',
        'product_id',
        'price',
        'discount',
        'quantity',
        'cancel_date',
        'cancel_time'
    ];
}
