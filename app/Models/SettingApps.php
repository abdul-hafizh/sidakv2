<?php

namespace App\Models;

use Eloquent as Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class SettingApps extends Model
{
     // use SoftDeletes;

    public $table = 'setting_apps';
    

   // protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'logo_lg',
        'logo_sm',
        'about',
        'address',
        'contact',
        'facebook',
        'instagram',
        'twitter'
    ];


    
    
}
