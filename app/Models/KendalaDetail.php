<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

// use Illuminate\Database\Eloquent\SoftDeletes;

class KendalaDetail extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'kendala_detail';
    

   // protected $dates = ['deleted_at'];


    public $fillable = [
     
        'kendala_id',
        'from',
        'sender',
        'messages',
        'status',
        'created_by'
       
    ];


    
    
}
