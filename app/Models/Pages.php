<?php

namespace App\Models;

use Eloquent as Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class Pages extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'pages';
    

   // protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'slug',
        'path_api',
        'role_id',
        'foldername',
        'filename',
        'type',
        'label_list',
        'limit_table',
        'action_table',
        'search',
        'paginate',
        'created_by',
        'updated_by'
       
    ];

   
    
    
}
