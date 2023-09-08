<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

// use Illuminate\Database\Eloquent\SoftDeletes;

class TopicDetail extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'topic_detail';
    

   // protected $dates = ['deleted_at'];


    public $fillable = [
     
        'topic_id',
        'messages',
        'status',
        'created_by'
       
    ];


    
    
}
