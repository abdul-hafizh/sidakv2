<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

// use Illuminate\Database\Eloquent\SoftDeletes;

class Kriteria extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'kriteria_kendala';
    

   // protected $dates = ['deleted_at'];


    public $fillable = [
     
        'category',
        'description',
        'slug',
        'status',
        'created_by'
       
    ];


    
    
}
