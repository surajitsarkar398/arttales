<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_name',
        'price',
        'discount',
        'offer_price',
       'product_image',
        'product_description',
        'limited_stock',
        'sell_product',
        'post_id',
        'register_id',
        'store_id',
        'payment_method'
    ];

    protected $casts = [
        'product_image' => 'array',
    ];
}
