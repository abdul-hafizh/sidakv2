<?php

namespace App\Models;

use Eloquent as Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;


class Pemetaan extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'pemetaan';
    // protected $dates = ['deleted_at'];

    public $fillable = [
            
            "periode_id",
            "daerah_id",
            "type",

            "tgl_awal_rencana_kerja",
            "tgl_ahir_rencana_kerja",
            "budget_rencana_kerja",
            "keterangan_rencana_kerja",

            "tgl_awal_studi_literatur",
            "tgl_ahir_studi_literatur",
            "budget_studi_literatur",
            "keterangan_studi_literatur",

            "tgl_awal_rapat_kordinasi",
            "tgl_ahir_rapat_kordinasi",
            "budget_rapat_kordinasi",
            "keterangan_rapat_kordinasi",

            "tgl_awal_data_sekunder",
            "tgl_ahir_data_sekunder",
            "budget_data_sekunder",
            "keterangan_data_sekunder",

            "tgl_awal_fgd_persiapan",
            "tgl_ahir_fgd_persiapan",
            "budget_fgd_persiapan",
            "keterangan_fgd_persiapan",


            "tgl_awal_fgd_identifikasi",
            "tgl_ahir_fgd_identifikasi",
            "budget_fgd_identifikasi",
            "keterangan_fgd_identifikasi",

            "tgl_awal_lq",
            "tgl_ahir_lq",
            "budget_lq",
            "keterangan_lq",

            "tgl_awal_shift_share",
            "tgl_ahir_shift_share",
            "budget_shift_share",
            "keterangan_shift_share",

            "tgl_awal_tipologi_sektor",
            "tgl_ahir_tipologi_sektor",
            "budget_tipologi_sektor",
            "keterangan_tipologi_sektor",

            "tgl_awal_klassen",
            "tgl_ahir_klassen",
            "budget_klassen",
            "keterangan_klassen",

            "tgl_awal_fgd_klarifikasi",
            "tgl_ahir_fgd_klarifikasi",
            "budget_fgd_klarifikasi",
            "keterangan_fgd_klarifikasi",

            
            "tgl_awal_finalisasi",
            "tgl_ahir_finalisasi",
            "budget_finalisasi",
            "keterangan_finalisasi",

            

            "tgl_awal_summary_sektor_unggulan",
            "tgl_ahir_summary_sektor_unggulan",
            "budget_summary_sektor_unggulan",
            "keterangan_summary_sektor_unggulan",

            "tgl_awal_sektor_unggulan",
            "tgl_ahir_sektor_unggulan",
            "budget_sektor_unggulan",
            "keterangan_sektor_unggulan",

            "tgl_awal_potensi_pasar",
            "tgl_ahir_potensi_pasar",
            "budget_potensi_pasar",
            "keterangan_potensi_pasar",

            "tgl_awal_parameter_sektor_unggulan",
            "tgl_ahir_parameter_sektor_unggulan",
            "budget_parameter_sektor_unggulan",
            "keterangan_parameter_sektor_unggulan",

            "tgl_awal_subsektor_unggulan",
            "tgl_ahir_subsektor_unggulan",
            "budget_subsektor_unggulan",
            "keterangan_subsektor_unggulan",

            "tgl_awal_intensif_daerah",
            "tgl_ahir_intensif_daerah",
            "budget_intensif_daerah",
            "keterangan_intensif_daerah",

            "tgl_awal_potensi_lanjutan",
            "tgl_ahir_potensi_lanjutan",
            "budget_potensi_lanjutan",
            "keterangan_potensi_lanjutan",

            "tgl_awal_info_grafis",
            "tgl_ahir_info_grafis",
            "budget_info_grafis",
            "keterangan_info_grafis",

            "tgl_awal_dokumentasi",
            "tgl_ahir_dokumentasi",
            "budget_dokumentasi",
            "keterangan_dokumentasi",
            
            "created_by",
            "request_edit",
            "status_laporan_id",
            "alasan",
            "checklist",
       
    ];


    
    
}
