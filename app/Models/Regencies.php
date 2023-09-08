<?php

namespace App\Models;

use Eloquent as Model;
// use App\Traits\Uuids;

// use Illuminate\Database\Eloquent\SoftDeletes;

class Regencies extends Model
{
     // use SoftDeletes;
    // use Uuids;
    public $table = 'regencies';
    

   // protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'name',
        'province_id',
        'created_by',
       
       
    ];

    public function province()
    {
        return $this->belongsTo('App\Models\Provinces','province_id');
    }



    
    
}
