<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

class Pengawasan extends Model
{
    use Uuids;
    public $table = 'pengawasan';

    public $fillable = [
           
            'daerah_id',
            'periode_id',
           
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

            'upload_lap_profil_pengawasan',
            'upload_bap_pengawasan',

            'nama_kegiatan',
            'tgl_kegiatan',
            'lokasi_kegiatan',
            'biaya_kegiatan',
            'rencana_kegiatan',
            'is_skpd_sesuai',
            
            'is_fasilitasi',
            'created_by',
            'created_date',
            'modified_date',
            'modified_by',
            'status_laporan_id',
            'lap_evaluasi',
            'lap_kegiatan',
            'lap_lkpm',
            'lap_bap',
            'lap_profile',
            'sub_menu',
            'sub_menu_slug',
            'request_edit',
        ];
    
}
