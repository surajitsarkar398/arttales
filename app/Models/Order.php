<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
 	protected $primaryKey = 'order_id';
    protected $fillable = [
        'register_id',
        'product_id',
        'product_image',
        'store_id',
        'orders_id',
        'store_category',
        'payment',
        'dates',
        'times',
        'payment_method',
        'cancel_reason',
        'status',
        'cancel_date',
        'cancel_time'

    ];
}
