<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment_like extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'register_id',
        'comment_id',
        'is_like',
    ];
}
?>
