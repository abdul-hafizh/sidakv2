<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

// use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'forum';
    

   // protected $dates = ['deleted_at'];


    public $fillable = [
     
        'category',
        'description',
        'status',
        'created_by'
       
    ];


    
    
}
