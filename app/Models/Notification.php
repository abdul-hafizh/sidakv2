<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

// use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'notification';
    

   // protected $dates = ['deleted_at'];


    public $fillable = [
     
        'type',
        'from',
        'sender',
        'messages',
        'view',
        'status',
        'created_by'
       
    ];


    
    
}
