<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $primaryKey = 'post_id';
    protected $fillable = [
        'post_image',
        'descriptions',
        'tags',
        'type',
        'product_id',
        'register_id',

    ];
}
