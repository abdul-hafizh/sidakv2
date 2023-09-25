<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

// use Illuminate\Database\Eloquent\SoftDeletes;

class AuditLog extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'audit_log';
    

   // protected $dates = ['deleted_at'];


    public $fillable = [
     
        'category',
        'group_menu',
        'description',
        'client_ip',
        'user_agent',
        'role_user',
        'created_by',

       
    ];


    
    
}
