<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

class Perencanaan extends Model
{
    use Uuids;
    public $table = 'perencanaan';

    public $fillable = [
        'daerah_id',
        'periode_id',
        'pengawas_analisa_target',
        'pengawas_analisa_satuan',
        'pengawas_analisa_pagu',

        'pengawas_inspeksi_target',
        'pengawas_inspeksi_satuan',
        'pengawas_inspeksi_pagu',

        'pengawas_evaluasi_target',
        'pengawas_evaluasi_satuan',
        'pengawas_evaluasi_pagu',

        'bimtek_perizinan_target',
        'bimtek_perizinan_satuan',
        'bimtek_perizinan_pagu',

        'bimtek_pengawasan_target',
        'bimtek_pengawasan_satuan',
        'bimtek_pengawasan_pagu',

        'penyelesaian_identifikasi_target',
        'penyelesaian_identifikasi_satuan',
        'penyelesaian_identifikasi_pagu',

        'penyelesaian_realisasi_target',
        'penyelesaian_realisasi_satuan',
        'penyelesaian_realisasi_pagu',

        'penyelesaian_evaluasi_target',
        'penyelesaian_evaluasi_satuan',
        'penyelesaian_evaluasi_pagu',

        'promosi_pengadaan_target',
        'promosi_pengadaan_satuan',
        'promosi_pengadaan_pagu',

        'tgl_tandatangan',
        'nama_pejabat',
        'nip_pejabat',

        'lokasi',
        'request_edit',
        'status',
        'lap_rencana',
        'created_by',       
    ];
}
