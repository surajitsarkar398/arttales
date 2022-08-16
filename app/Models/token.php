<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class token extends Model
{
    protected $table = 'tokens';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'register_id',
        'token',
    ];

    public static function getUserId($token){
        $user = token::where('token','like',$token)->first();
        return $user;
    
    }
}
