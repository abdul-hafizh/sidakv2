<?php

namespace App\Models;

use Eloquent as Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;
class Menus extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'menus';
    

   // protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'slug',
        'path_web',
        'parent',        
        'icon',
        'icon_hover',
        'created_by',
        'modified_by',
        'status'
    ];

    //  public function RoleMenu()
    // {
    //     return $this->belongsTo('App\Models\RoleMenu','role_id');
    // }
    
    
}
