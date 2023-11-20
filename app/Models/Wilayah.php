<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

// use Illuminate\Database\Eloquent\SoftDeletes;

class Wilayah extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'wilayah';
    

   // protected $dates = ['deleted_at'];


    public $fillable = [
     
        'name',
        'slug',
        'status',
        'created_by'
       
    ];


    
    
}
