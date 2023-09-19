<?php

namespace App\Models;

use App\Traits\Uuids;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimsos extends Model
{
    use Uuids;
    public $table = 'bimsos';

    public $fillable = [

        'daerah_id',
        'periode_id',
        'sub_menu_slug',
        'nama_kegiatan',
        'tgl_bimtek',
        'lokasi_bimtek',
        'biaya_kegiatan',
        'jml_peserta',
        'ringkasan_kegiatan',
        'lap_hadir',
        'lap_pendamping',
        'lap_notula',
        'lap_survey',
        'lap_narasumber',
        'lap_materi',
        'lap_document',
        'is_skpd_sesuai',
    ];
}
