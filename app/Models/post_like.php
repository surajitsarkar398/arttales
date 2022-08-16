<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post_like extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'register_id',
        'post_id',
        'is_like',
    ];
}
?>
