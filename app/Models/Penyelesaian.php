<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

class Penyelesaian extends Model
{
    use Uuids;
    public $table = 'penyelesaian';

    public $fillable = [
        'periode_id',
        'daerah_id',
        'nama_kegiatan',
        'sub_menu',
        'tgl_kegiatan',
        'biaya',
        'lokasi',
        'lap_peserta',
        'lap_profile',
        'lap_profile2',
        'lap_narasumber',
        'lap_notula',
        'lap_notula2',
        'lap_lkpm',
        'lap_document',
        'lap_evaluasi',
        'jml_perusahaan',
        'sub_menu_slug',
        'request_edit',
        'status_laporan_id',
        'created_by',
    ];
}
