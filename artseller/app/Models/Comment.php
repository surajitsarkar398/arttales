<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'register_id',
        'requet_id',
        'post_id',
        'product_id',
        'Comment',
        'tag',
        'dtCurrentDate',
    ];
}
