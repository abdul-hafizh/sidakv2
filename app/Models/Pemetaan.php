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
           

            "checklist_rk",
            "checklist_sl",
            "checklist_kor",
            "checklist_ds",
          
            "type_potensi",
            "tgl_awal_potensi",
            "tgl_ahir_potensi",
            "budget_potensi",
            "realisasi_potensi",
            "keterangan_potensi",

          
            "type_fgd_persiapan",
            "tgl_awal_fgd_persiapan",
            "tgl_ahir_fgd_persiapan",
            "budget_fgd_persiapan",
            "realisasi_fgd_persiapan",
            "keterangan_fgd_persiapan",

            "type_fgd_identifikasi",
            "tgl_awal_fgd_identifikasi",
            "tgl_ahir_fgd_identifikasi",
            "budget_fgd_identifikasi",
            "realisasi_fgd_identifikasi",
            "keterangan_fgd_identifikasi",
          
            "checklist_lq",
            "checklist_shift_share",
            "checklist_tipologi_sektor",
            "checklist_klassen",
           
            "type_sektor",
            "tgl_awal_sektor",
            "tgl_ahir_sektor",
            "budget_sektor",
            "realisasi_sektor",
            "keterangan_sektor",

            "type_fgd_klarifikasi",
            "tgl_awal_fgd_klarifikasi",
            "tgl_ahir_fgd_klarifikasi",
            "budget_fgd_klarifikasi",
            "realisasi_fgd_klarifikasi",
            "keterangan_fgd_klarifikasi",

            "type_fgd_finalisasi", 
            "tgl_awal_finalisasi",
            "tgl_ahir_finalisasi",
            "budget_finalisasi",
            "realisasi_finalisasi",
            "keterangan_finalisasi",

            
            "checklist_summary_sektor_unggulan",
            "checklist_sektor_unggulan", 
            "checklist_potensi_pasar",
            "checklist_parameter_sektor_unggulan",
            "checklist_subsektor_unggulan",
            "checklist_intensif_daerah",
            "checklist_potensi_lanjutan",

            "type_penyusunan",
            "tgl_awal_penyusunan",
            "tgl_ahir_penyusunan",
            "budget_penyusunan",
            "realisasi_penyusunan",
            "keterangan_penyusunan",
         
            "type_infografis",
            "tgl_awal_info_grafis",
            "tgl_ahir_info_grafis",
            "budget_info_grafis",
            "realisasi_info_grafis",
            "keterangan_info_grafis",

            "type_dokumentasi",
            "tgl_awal_dokumentasi",
            "tgl_ahir_dokumentasi",
            "budget_dokumentasi",
            "realisasi_dokumentasi",
            "keterangan_dokumentasi",
            
            "created_by",
            "request_edit",
            "status_laporan_id",
            "alasan",
            "checklist",
            "request_edit_by",
       
    ];


    
    
}
