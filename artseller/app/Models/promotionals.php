<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promotionals extends Model
{
    protected $primaryKey = 'promotion_id';
    protected $fillable = [
        'post_id',
        'budget_daily',
        'duration_days',
        'estimated_reach',
        'total_spend',
        'tax',
        
    ];

}
