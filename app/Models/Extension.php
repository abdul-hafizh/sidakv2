<?php

namespace App\Models;

use Eloquent as Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class Extension extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'periode_extension';
    // protected $dates = ['deleted_at'];

    public $fillable = [
        'daerah_id',
        'semester',
        'year',
        'expireddate',
        'extensiondate',
        'status',
        'checklist',
        'description',
        'created_by'
       
    ];


    
    
}
