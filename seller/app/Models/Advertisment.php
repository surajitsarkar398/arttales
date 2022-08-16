<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisment extends Model
{
  protected $primaryKey = 'id';
    protected $fillable = [
   	   'register_id',
   	   'product_id',
       'post_id',
       'store_id',
   	   'ads_type',
       'start_date',
       'end_date',
       'is_approval',
   	  //  'budget',
       //'audience_type',
   	  //  'duration',
   	  //  'payment_method',
      //   'attachment'

    ];
}
