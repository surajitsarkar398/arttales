<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference_subcategory extends Model
{
    protected $primaryKey = 'preference_subcategories_id';
    public $timestamps = false;
    protected $fillable = [
        'preference_subcategories_name',
        'language',
        'id',
    ]; 
}
