<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class report_users extends Model
{
    protected $primaryKey = 'report_id';
    protected $fillable = [
        'register_id',
        'is_report',
        'report_by',
        'description',
    ];
}
