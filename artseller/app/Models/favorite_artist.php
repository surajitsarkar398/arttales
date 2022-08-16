<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorite_artist extends Model
{
    protected $primaryKey = 'id	';
    protected $fillable = [
        'register_id',
        'requested_id',
        'is_favorite'
    ];
}
