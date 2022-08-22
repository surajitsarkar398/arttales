<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    
    public $timestamps = false;
    
    protected $primaryKey ='register_id';  
    
    protected $fillable = [
        'name',
        'country_code',
        'mobile',
        'dob',
        'email',
        'password',
        'image',
        'bio',
        'website',
        'major_achive',
        'genres',
        'work_at',
        'performance',
        'visiting_card',
        'main_category_name',
        'sub_category_name',
        'role',
        'type',
        'user_type',
        'created_at',
        'updated_at',
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'register_password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUser($email,$id)
    {
        $query = User::query();
       
        if(isset($email)){
            
            $query = $query->where("email",$email)->first();
           
        }else{
            $query = $query->where("register_id",$id)->first();
        }
        
        return $query;
    }
}
