<?php

namespace App\Models;

use Eloquent as Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;
class MenusRole extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'menus_roles';
    

   // protected $dates = ['deleted_at'];

    public $fillable = [
        'role_id',
        'menu_json',
        'created_by'
    ];

     public function role()
    {
        return $this->belongsTo('App\Models\Roles','role_id');
    }
    
}
