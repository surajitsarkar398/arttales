<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisment extends Model
{
  protected $primaryKey = 'ads_id';
    protected $fillable = [
        'store_id',
   	   'register_id',
   	   'product_id',
       'post_id',
   	   'ads_type',
   	   'audience_type',
       'start_date',
       'end_date',
   	   'budget',
   	   'duration',
   	   'payment_method',
        'attachment'

    ];
}
