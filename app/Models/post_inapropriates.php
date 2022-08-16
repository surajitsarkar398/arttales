<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post_inapropriates extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'post_id',
        'register_id',
        'is_inapropriate',
        
    ];
}
