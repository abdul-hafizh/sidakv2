<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

// use Illuminate\Database\Eloquent\SoftDeletes;

class Kendala extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'kendala';
    

   // protected $dates = ['deleted_at'];


    public $fillable = [
        'kriteria_id',
        'permasalahan',
        'from',
        'sender',
        'messages',
        'status',
        'created_by'
       
    ];


     public function kriteria()
    {
        return $this->belongsTo('App\Models\Kriteria','kriteria_id');
    }
    
}
