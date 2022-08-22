<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerProfile extends Model
{
    protected $primaryKey = 'register_id';
    protected $fillable = [
        'name',
        'country_code',
        'mobile',
        'dob',
        'email',
        'password',
        'image',
        'description',
        'major_achivement',
        'genres',
        'work_at',
        'performance',
    ];
}
