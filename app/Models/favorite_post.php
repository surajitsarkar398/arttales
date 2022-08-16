<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorite_post extends Model
{
    protected $primaryKey = 'id	';
    protected $fillable = [
        'post_id',
        'register_id',
        'is_favorite'
    ];
}
