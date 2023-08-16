<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

// use Illuminate\Database\Eloquent\SoftDeletes;

class SystemLog extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'system_log';
    

   // protected $dates = ['deleted_at'];


    public $fillable = [
     
        'menu',
        'slug',
        'url',
        'created_by'
       
    ];


    
    
}
