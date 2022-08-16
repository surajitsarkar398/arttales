<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post_shares extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'post_id',
        'share_with',
        'share_by',
        'post_link',
    ];
}
