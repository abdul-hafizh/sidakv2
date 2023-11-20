<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

class Pengawasan_perusahaan extends Model
{
    use Uuids;
    public $table = 'pengawasan_perusahaan';

    public $fillable = [

        'pengawasan_id',

        'nama_perusahaan',
        'kontak',

        'nib',
        'tgl_nib',

        'no_izin_lokasi',
        'tgl_izin_lokasi',

        'no_izin_amdal',
        'tgl_izin_amdal',

        'no_izin_lingkungan',
        'tgl_izin_lingkungan',

        'no_imb',
        'tgl_imb',

        'total_rencana_inv',
        'total_realisasi_inv',

        'rencana_tki',
        'realisasi_tki',
        'rencana_tka',
        'realisasi_tka',

        'lap_evaluasi',
        'lap_lkpm',
        'lap_bap',
        'lap_profile',

        'created_by',
        'created_date',
        'modified_date',
        'modified_by'
    ];
}
