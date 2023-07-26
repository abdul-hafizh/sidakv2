<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

// use Illuminate\Database\Eloquent\SoftDeletes;

class Provinces extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'provinces';
    

   // protected $dates = ['deleted_at'];


    public $fillable = [
     
        'name',
       
       
    ];


    
    
}
