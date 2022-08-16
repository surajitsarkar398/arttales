<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'order_id',
        'seller_id',
        'shop_id',
        'product_id',
        'variation',
        'price',
        'tax',
        'shipping_cost',
        'discount',
        'payment_status',
        'delivery_status',
        'pickup_point_id',
        'product_referral_code'
      ];
}
