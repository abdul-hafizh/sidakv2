<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

// use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'role';
    

   // protected $dates = ['deleted_at'];


    public $fillable = [
     
        'name',
        'slug',
        'status',
        'created_by'
       
    ];


    
    
}
