<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Savepost extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'register_id',
        'post_id',
    ];
}
?>