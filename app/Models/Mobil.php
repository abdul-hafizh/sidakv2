<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

// use Illuminate\Database\Eloquent\SoftDeletes;

class Mobil extends Model
{
    // use SoftDeletes;
    use Uuids;
    public $table = 'mobil';


    // protected $dates = ['deleted_at'];


    public $fillable = [

        'merk',
        'type'

    ];
}
