<?php

namespace App\Models;

use Eloquent as Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;
class Periode extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'periode';
    // protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'slug',
        'semester',
        'year',
        'status',
        'created_by'
       
    ];


    
    
}
