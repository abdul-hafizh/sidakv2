<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

// use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'topic';
    

   // protected $dates = ['deleted_at'];


    public $fillable = [
     
        'name',
        'slug',
        'forum_id',
        'status',
        'created_by'
       
    ];


    
    
}
