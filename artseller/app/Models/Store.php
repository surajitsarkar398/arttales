<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $primaryKey = 'store_id';
    protected $fillable = [
        'store_name',
        'store_code',
        'store_image',
        'category',
        'mobile',
        'email',
        'website',
        'address',
        'register_id',
        'attachment',
        'detail'

    ];
}
