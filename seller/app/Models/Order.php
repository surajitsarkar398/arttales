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
        'store_id',
        'orders_id',
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
