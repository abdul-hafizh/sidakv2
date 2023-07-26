<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

// use Illuminate\Database\Eloquent\SoftDeletes;

class Regencies extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'regencies';
    

   // protected $dates = ['deleted_at'];


    public $fillable = [
     
        'name',
        'province_id',
       
       
    ];


    
    
}
