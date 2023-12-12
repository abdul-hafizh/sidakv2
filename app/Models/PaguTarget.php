<?php

namespace App\Models;

use Eloquent as Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class PaguTarget extends Model
{
    // use SoftDeletes;
    use Uuids;
    public $table = 'pagu_target';


    // protected $dates = ['deleted_at'];


    public $fillable = [

        'nama_daerah',
        'daerah_id',
        'periode_id',
        'pagu_apbn',
        'pagu_promosi',
        'type_daerah',
        'pagu_pengawasan',
        'pagu_penyelesaian_permasalahan',
        'pagu_bimbingan_teknis',
        'target_pengawasan',
        'target_penyelesaian_permasalahan',
        'target_bimbingan_teknis',
        'target_video_promosi',
        'pagu_dalak',
    ];
}
