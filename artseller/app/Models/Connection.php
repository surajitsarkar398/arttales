<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Connection extends Model
{
    protected $table = 'connections';
    public $timestamps = false;
	protected $primaryKey ='connection_id';
    protected $fillable = [
        'connection_id',
        'register_id',
        'requested_id',
        'vConnection',
        'is_block',
    ];

    public static function getUser($vConnection,$id)
    {
        $query = Connection::query();
       
        if(isset($vConnection)){
            
            $query = $query->where("vConnection",$vConnection)->first();
           
        }else{
            $query = $query->where("connection_id",$id)->first();
        }
        
        return $query;
    }

    public static function getUsers($vConnection,$register_id)
    {
        $query = Connection::query();
       
        if(isset($vConnection)){
            
            $query = $query->where("vConnection",$vConnection)->first();
           
        }else{
            $query = $query->where("register_id",$register_id)->first();
        }
        
        return $query;
    }
}
