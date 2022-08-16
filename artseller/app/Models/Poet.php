<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poet extends Model
{
    protected $table = 'poets';
    protected $primaryKey = 'id ';
    protected $fillable = [
        'poet_name'
    ];
}
