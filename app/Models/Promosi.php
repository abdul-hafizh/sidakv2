<?php

namespace App\Models;

use Eloquent as Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;


class Promosi extends Model
{
     // use SoftDeletes;
    use Uuids;
    public $table = 'promosi';
    // protected $dates = ['deleted_at'];

    public $fillable = [
            
            "periode_id",
            "daerah_id",
            "tgl_awal_peluang",
            "tgl_ahir_peluang",
            "budget_peluang",
            "keterangan_peluang",
            "tgl_awal_storyline",
            "tgl_ahir_storyline",
            "budget_storyline",
            "keterangan_storyline",
            "tgl_awal_storyboard",
            "tgl_ahir_storyboard",
            "budget_storyboard",
            "keterangan_storyboard",
            "tgl_awal_lokasi",
            "tgl_ahir_lokasi",
            "budget_lokasi",
            "keterangan_lokasi",
            "tgl_awal_talent",
            "tgl_ahir_talent",
            "budget_talent",
            "keterangan_talent",
            "tgl_awal_testimoni",
            "tgl_ahir_testimoni",
            "budget_testimoni",
            "keterangan_testimoni",
            "tgl_awal_audio",
            "tgl_ahir_audio",
            "budget_audio",
            "keterangan_audio",
            "tgl_awal_editing",
            "tgl_ahir_editing",
            "budget_editing",
            "keterangan_editing",
            "tgl_awal_gambar",
            "tgl_ahir_gambar",
            "budget_gambar",
            "keterangan_gambar",
            "tgl_awal_video",
            "tgl_ahir_video",
            "budget_video",
            "keterangan_video",
            "tgl_awal_editvideo",
            "tgl_ahir_editvideo",
            "budget_editvideo",
            "keterangan_editvideo",
            "tgl_awal_grafik",
            "tgl_ahir_grafik",
            "budget_grafik",
            "keterangan_grafik",
            "tgl_awal_mixing",
            "tgl_ahir_mixing",
            "budget_mixing",
            "keterangan_mixing",
            "tgl_awal_voice",
            "tgl_ahir_voice",
            "budget_voice",
            "keterangan_voice",
            "tgl_awal_subtitle",
            "tgl_ahir_subtitle",
            "budget_subtitle",
            "keterangan_subtitle",
            "created_by",
            "request_edit",
            "status_laporan_id",
            "alasan",
            "checklist",
       
    ];


    
    
}
