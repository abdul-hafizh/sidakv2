<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;
// use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'user_roles';
    

   // protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'role_id',
        'status',
        'created_by',
        'modified_by'
       
    ];


    public function role()
    {
        return $this->belongsTo('App\Models\Roles','role_id');
    }

    public function menu()
    {
        return $this->belongsTo('App\Models\RoleMenu','role_id');
    }
    
}
