<?php

namespace App\Http\Request;

use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use App\Helpers\GeneralPaginate;
use App\Helpers\GeneralHelpers;
use App\Models\Perencanaan;
use App\Models\Roles;
use App\Models\Periode;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestDaerah;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestPeriode;
use App\Http\Request\RequestMenuRoles;

class RequestPerencanaan
{

    public static function GetDataAll($data, $perPage, $request)
    {
        $temp = array();
        $getRequest = $request->all();
        $page = isset($getRequest['page']) ? $getRequest['page'] : 1;

        if ($perPage != 'all') {
            $numberNext = (($page * $perPage) - ($perPage - 1));
        } else {
            $numberNext = (($page * $data->count()) - ($data->count() - 1));
        }

        foreach ($data as $key => $val) {
            $periode = RequestPerencanaan::GetPeriodeYear($val->periode_id);
            if ($periode != "") {
                $temp[$key]['number'] = $numberNext++;
                $temp[$key]['id'] = $val->id;
                $temp[$key]['access'] = RequestAuth::Access();
                $temp[$key]['nama_daerah'] = RequestDaerah::GetDaerahWhereID($val->daerah_id);
                $temp[$key]['pengawas_analisa_pagu'] = $val->pengawas_analisa_pagu;
                $temp[$key]['pengawas_analisa_pagu_convert'] = GeneralHelpers::formatRupiah($val->pengawas_analisa_pagu);
                $temp[$key]['pengawas_inspeksi_pagu'] = $val->pengawas_inspeksi_pagu;
                $temp[$key]['pengawas_inspeksi_pagu_convert'] = GeneralHelpers::formatRupiah($val->pengawas_inspeksi_pagu);
                $temp[$key]['pengawas_evaluasi_pagu'] = $val->pengawas_evaluasi_pagu;
                $temp[$key]['pengawas_evaluasi_pagu_convert'] = GeneralHelpers::formatRupiah($val->pengawas_evaluasi_pagu);
                $temp[$key]['bimtek_perizinan_pagu'] = $val->bimtek_perizinan_pagu;
                $temp[$key]['bimtek_perizinan_pagu_convert'] = GeneralHelpers::formatRupiah($val->bimtek_perizinan_pagu);
                $temp[$key]['bimtek_pengawasan_pagu'] = $val->bimtek_pengawasan_pagu;
                $temp[$key]['bimtek_pengawasan_pagu_convert'] = GeneralHelpers::formatRupiah($val->bimtek_pengawasan_pagu);
                $temp[$key]['penyelesaian_identifikasi_pagu'] = $val->penyelesaian_identifikasi_pagu;
                $temp[$key]['penyelesaian_identifikasi_pagu_convert'] = GeneralHelpers::formatRupiah($val->penyelesaian_identifikasi_pagu);
                $temp[$key]['penyelesaian_realisasi_pagu'] = $val->penyelesaian_realisasi_pagu;
                $temp[$key]['penyelesaian_realisasi_pagu_convert'] = GeneralHelpers::formatRupiah($val->penyelesaian_realisasi_pagu);
                $temp[$key]['penyelesaian_evaluasi_pagu'] = $val->penyelesaian_evaluasi_pagu;
                $temp[$key]['penyelesaian_evaluasi_pagu_convert'] = GeneralHelpers::formatRupiah($val->penyelesaian_evaluasi_pagu);
                $temp[$key]['promosi_pengadaan_pagu'] = $val->promosi_pengadaan_pagu;
                $temp[$key]['promosi_pengadaan_pagu_convert'] = GeneralHelpers::formatRupiah($val->promosi_pengadaan_pagu);
                $temp[$key]['periode'] =  $periode;
                $temp[$key]['total_rencana_pengawasan'] = $val->pengawas_analisa_pagu + $val->pengawas_inspeksi_pagu + $val->pengawas_evaluasi_pagu;
                $temp[$key]['total_rencana_bimsos'] = $val->bimtek_perizinan_pagu + $val->bimtek_pengawasan_pagu;
                $temp[$key]['total_rencana_masalah'] = $val->penyelesaian_identifikasi_pagu + $val->penyelesaian_realisasi_pagu + $val->penyelesaian_evaluasi_pagu;
                $temp[$key]['total_pagu'] =  GeneralHelpers::formatRupiah($val->pengawas_analisa_pagu + $val->pengawas_inspeksi_pagu + $val->pengawas_evaluasi_pagu + $val->bimtek_perizinan_pagu + $val->bimtek_pengawasan_pagu + $val->penyelesaian_identifikasi_pagu + $val->penyelesaian_realisasi_pagu + $val->penyelesaian_evaluasi_pagu + $val->promosi_pengadaan_pagu + $val->pagu_promosi);
                $temp[$key]['total_pagu_export'] =  $val->pengawas_analisa_pagu + $val->pengawas_inspeksi_pagu + $val->pengawas_evaluasi_pagu + $val->bimtek_perizinan_pagu + $val->bimtek_pengawasan_pagu + $val->penyelesaian_identifikasi_pagu + $val->penyelesaian_realisasi_pagu + $val->penyelesaian_evaluasi_pagu + $val->promosi_pengadaan_pagu + $val->pagu_promosi;
                $temp[$key]['status'] = RequestPerencanaan::getLabelStatus($val->status, $val->request_edit);
                $temp[$key]['deleted'] = RequestPerencanaan::checkValidate($val->status);
                $temp[$key]['created_at'] = GeneralHelpers::tanggal_indo($val->created_at);
                $temp[$key]['updated_at'] = GeneralHelpers::tanggal_indo($val->updated_at);
                $temp[$key]['lap_rencana'] = $val->lap_rencana;
                $temp[$key]['status_code'] = $val->status;
                $temp[$key]['alasan_unapprove'] = $val->alasan_unapprove;
                $temp[$key]['alasan_unapprove_doc'] = $val->alasan_unapprove_doc;
                $temp[$key]['alasan_edit'] = $val->alasan_edit;
                $temp[$key]['alasan_revisi'] = $val->alasan_revisi;
                $temp[$key]['created_at_export'] = $val->created_at;
                $temp[$key]['updated_at_export'] = $val->updated_at;
            }
        }

        $result['data'] = $temp;
        $result['options'] = RequestMenuRoles::ActionPage('perencanaan');
        if ($perPage != 'all') {
            $result['current_page'] = $data->currentPage();
            $result['last_page'] = $data->lastPage();
            $result['total'] = $data->total();
        } else {
            $result['current_page'] = 1;
            $result['last_page'] = 1;
            $result['total'] = $data->count();
        }

        return $result;
    }

    public static function GetDataAllExport($data, $request)
    {
        $no = 1;
        $temp = array();
        $getRequest = $request->all();

        foreach ($data as $key => $val) {
            $periode = RequestPerencanaan::GetPeriodeYear($val->periode_id);
            if ($periode != "") {
                $temp[$key]['number'] = $no++;
                $temp[$key]['id'] = $val->id;
                $temp[$key]['nama_daerah'] = $val->wilayah;
                $temp[$key]['pengawas_analisa_pagu'] = $val->pengawas_analisa_pagu;
                $temp[$key]['pengawas_inspeksi_pagu'] = $val->pengawas_inspeksi_pagu;
                $temp[$key]['pengawas_evaluasi_pagu'] = $val->pengawas_evaluasi_pagu;
                $temp[$key]['bimtek_perizinan_pagu'] = $val->bimtek_perizinan_pagu;
                $temp[$key]['bimtek_pengawasan_pagu'] = $val->bimtek_pengawasan_pagu;
                $temp[$key]['penyelesaian_identifikasi_pagu'] = $val->penyelesaian_identifikasi_pagu;
                $temp[$key]['penyelesaian_realisasi_pagu'] = $val->penyelesaian_realisasi_pagu;
                $temp[$key]['penyelesaian_evaluasi_pagu'] = $val->penyelesaian_evaluasi_pagu;
                $temp[$key]['promosi_pengadaan_pagu'] = $val->promosi_pengadaan_pagu;
                $temp[$key]['periode'] =  $periode;
                $temp[$key]['total_rencana_pengawasan'] = $val->pengawas_analisa_pagu + $val->pengawas_inspeksi_pagu + $val->pengawas_evaluasi_pagu;
                $temp[$key]['total_rencana_bimsos'] = $val->bimtek_perizinan_pagu + $val->bimtek_pengawasan_pagu;
                $temp[$key]['total_rencana_masalah'] = $val->penyelesaian_identifikasi_pagu + $val->penyelesaian_realisasi_pagu + $val->penyelesaian_evaluasi_pagu;
                $temp[$key]['total_pagu_export'] =  $val->pengawas_analisa_pagu + $val->pengawas_inspeksi_pagu + $val->pengawas_evaluasi_pagu + $val->bimtek_perizinan_pagu + $val->bimtek_pengawasan_pagu + $val->penyelesaian_identifikasi_pagu + $val->penyelesaian_realisasi_pagu + $val->penyelesaian_evaluasi_pagu + $val->promosi_pengadaan_pagu + $val->pagu_promosi;
                $temp[$key]['status'] = RequestPerencanaan::getLabelStatus($val->status, $val->request_edit);
                $temp[$key]['deleted'] = RequestPerencanaan::checkValidate($val->status);
                $temp[$key]['created_at'] = GeneralHelpers::tanggal_indo($val->created_at);
                $temp[$key]['updated_at'] = GeneralHelpers::tanggal_indo($val->updated_at);
                $temp[$key]['created_at_export'] = $val->created_at;
                $temp[$key]['updated_at_export'] = $val->updated_at;
            }
        }

        $result['data'] = $temp;

        return $result;
    }

    public static function checkValidate($status)
    {

        if ($status == '13') {
            $result =  false;
        } else {
            $result =  true;
        }

        return  $result;
    }

    public static function GetDetailID($data)
    {
        $temp = array();

        $temp['id'] = $data->id;
        $temp['periode_id'] = $data->periode_id;
        $temp['access'] = RequestAuth::Access();
        $temp['options'] = RequestMenuRoles::ActionPage('perencanaan');
        $temp['periode_name'] = RequestPeriode::GetPeriodeName($data->periode_id);
        $temp['pagu_apbn'] = GeneralHelpers::formatRupiah($data->pagu_apbn);
        $temp['pagu_promosi'] = GeneralHelpers::formatRupiah($data->pagu_promosi);
        $temp['pagu_promosi_cek'] = $data->pagu_promosi;
        $temp['total_rencana'] =  GeneralHelpers::formatRupiah($data->pengawas_analisa_pagu + $data->pengawas_inspeksi_pagu + $data->pengawas_evaluasi_pagu + $data->bimtek_perizinan_pagu + $data->bimtek_pengawasan_pagu + $data->penyelesaian_identifikasi_pagu + $data->penyelesaian_realisasi_pagu + $data->penyelesaian_evaluasi_pagu);

        $temp['target_pengawasan'] = $data->target_pengawasan;
        $temp['target_bimtek'] = $data->target_bimbingan_teknis;
        $temp['target_penyelesaian'] = $data->target_penyelesaian_permasalahan;

        $temp['pengawas_analisa_target'] = $data->pengawas_analisa_target;
        $temp['pengawas_analisa_pagu'] = $data->pengawas_analisa_pagu;
        $temp['pengawas_analisa_pagu_convert'] = GeneralHelpers::formatRupiah($data->pengawas_analisa_pagu);
        $temp['pengawas_inspeksi_target'] = $data->pengawas_inspeksi_target;
        $temp['pengawas_inspeksi_pagu'] = $data->pengawas_inspeksi_pagu;
        $temp['pengawas_inspeksi_pagu_convert'] = GeneralHelpers::formatRupiah($data->pengawas_inspeksi_pagu);
        $temp['pengawas_evaluasi_target'] = $data->pengawas_evaluasi_target;
        $temp['pengawas_evaluasi_pagu'] = $data->pengawas_evaluasi_pagu;
        $temp['pengawas_evaluasi_pagu_convert'] = GeneralHelpers::formatRupiah($data->pengawas_evaluasi_pagu);

        $temp['total_target_pengawasan'] = $data->pengawas_analisa_target + $data->pengawas_inspeksi_target + $data->pengawas_evaluasi_target;
        $temp['total_pagu_pengawasan'] = $data->pengawas_analisa_pagu + $data->pengawas_inspeksi_pagu + $data->pengawas_evaluasi_pagu;
        $temp['total_pagu_pengawasan_convert'] = GeneralHelpers::formatRupiah($data->pengawas_analisa_pagu + $data->pengawas_inspeksi_pagu + $data->pengawas_evaluasi_pagu);

        $temp['bimtek_perizinan_target'] = $data->bimtek_perizinan_target;
        $temp['bimtek_perizinan_pagu'] = $data->bimtek_perizinan_pagu;
        $temp['bimtek_perizinan_pagu_convert'] = GeneralHelpers::formatRupiah($data->bimtek_perizinan_pagu);
        $temp['bimtek_pengawasan_target'] = $data->bimtek_pengawasan_target;
        $temp['bimtek_pengawasan_pagu'] = $data->bimtek_pengawasan_pagu;
        $temp['bimtek_pengawasan_pagu_convert'] = GeneralHelpers::formatRupiah($data->bimtek_pengawasan_pagu);

        $temp['total_target_bimtek'] = $data->bimtek_perizinan_target + $data->bimtek_pengawasan_target;
        $temp['total_pagu_bimtek'] = $data->bimtek_perizinan_pagu + $data->bimtek_pengawasan_pagu;
        $temp['total_pagu_bimtek_convert'] = GeneralHelpers::formatRupiah($data->bimtek_perizinan_pagu + $data->bimtek_pengawasan_pagu);

        $temp['penyelesaian_identifikasi_target'] = $data->penyelesaian_identifikasi_target;
        $temp['penyelesaian_identifikasi_pagu'] = $data->penyelesaian_identifikasi_pagu;
        $temp['penyelesaian_identifikasi_pagu_convert'] = GeneralHelpers::formatRupiah($data->penyelesaian_identifikasi_pagu);
        $temp['penyelesaian_realisasi_target'] = $data->penyelesaian_realisasi_target;
        $temp['penyelesaian_realisasi_pagu'] = $data->penyelesaian_realisasi_pagu;
        $temp['penyelesaian_realisasi_pagu_convert'] = GeneralHelpers::formatRupiah($data->penyelesaian_realisasi_pagu);
        $temp['penyelesaian_evaluasi_target'] = $data->penyelesaian_evaluasi_target;
        $temp['penyelesaian_evaluasi_pagu'] = $data->penyelesaian_evaluasi_pagu;
        $temp['penyelesaian_evaluasi_pagu_convert'] = GeneralHelpers::formatRupiah($data->penyelesaian_evaluasi_pagu);

        $temp['total_target_penyelesaian'] = $data->penyelesaian_identifikasi_target + $data->penyelesaian_realisasi_target + $data->penyelesaian_evaluasi_target;
        $temp['total_pagu_penyelesaian'] = $data->penyelesaian_identifikasi_pagu + $data->penyelesaian_realisasi_pagu + $data->penyelesaian_evaluasi_pagu;
        $temp['total_pagu_penyelesaian_convert'] = GeneralHelpers::formatRupiah($data->penyelesaian_identifikasi_pagu + $data->penyelesaian_realisasi_pagu + $data->penyelesaian_evaluasi_pagu);

        $temp['lokasi'] = $data->lokasi;
        $temp['status'] = RequestPerencanaan::getLabelStatus($data->status, $data->request_edit);
        $temp['status_code'] = $data->status;
        $temp['lap_rencana'] = $data->lap_rencana;
        $temp['request_edit'] = $data->request_edit;
        $temp['tgl_tandatangan'] = $data->tgl_tandatangan;
        $temp['nama_pejabat'] = $data->nama_pejabat;
        $temp['nip_pejabat'] = $data->nip_pejabat;
        $temp['alasan_unapprove'] = $data->alasan_unapprove;
        $temp['alasan_unapprove_doc'] = $data->alasan_unapprove_doc;
        $temp['alasan_edit'] = $data->alasan_edit;
        $temp['alasan_revisi'] = $data->alasan_revisi;

        return $temp;
    }

    public static function GetPeriodeYear($periode_id)
    {

        $periode = Periode::where('year', $periode_id)->first();

        if ($periode) {
            $result = $periode->year;
        } else {

            $result = '';
        }

        return $result;
    }

    public static function GetDaerahID($daerah_id)
    {

        $province = DB::table('provinces')->select('id as value', 'name as text');
        $regency = DB::table('regencies')->select('id as value', 'name')->where('id', $daerah_id)->union($province)->orderBy('value', 'ASC')->first();

        return $regency->name;
    }

    public static function GetDataID($data)
    {

        $__temp_['id'] = $data->id;
        $__temp_['name'] = $data->name;
        $__temp_['category'] = $data->category;
        $__temp_['price'] = $data->price;

        return $__temp_;
    }

    public static function fieldsData($request)
    {
        $fields = [
            'pengawas_analisa_target' => $request->pengawas_analisa_target,
            'pengawas_analisa_pagu' => $request->pengawas_analisa_pagu,
            'pengawas_inspeksi_target' => $request->pengawas_inspeksi_target,
            'pengawas_inspeksi_pagu' => $request->pengawas_inspeksi_pagu,
            'pengawas_evaluasi_target' => $request->pengawas_evaluasi_target,
            'pengawas_evaluasi_pagu' => $request->pengawas_evaluasi_pagu,

            'bimtek_perizinan_target' => $request->bimtek_perizinan_target,
            'bimtek_perizinan_pagu' => $request->bimtek_perizinan_pagu,
            'bimtek_pengawasan_target' => $request->bimtek_pengawasan_target,
            'bimtek_pengawasan_pagu' => $request->bimtek_pengawasan_pagu,

            'penyelesaian_identifikasi_target' => $request->penyelesaian_identifikasi_target,
            'penyelesaian_identifikasi_pagu' => $request->penyelesaian_identifikasi_pagu,
            'penyelesaian_realisasi_target' => $request->penyelesaian_realisasi_target,
            'penyelesaian_realisasi_pagu' => $request->penyelesaian_realisasi_pagu,
            'penyelesaian_evaluasi_target' => $request->penyelesaian_evaluasi_target,
            'penyelesaian_evaluasi_pagu' => $request->penyelesaian_evaluasi_pagu,

            'promosi_pengadaan_target' => $request->promosi_pengadaan_target,
            'promosi_pengadaan_satuan' => $request->promosi_pengadaan_satuan,
            'promosi_pengadaan_pagu' => $request->promosi_pengadaan_pagu,

            'periode_id' => $request->periode_id,
            'nama_pejabat' => $request->nama_pejabat,
            'nip_pejabat' => $request->nip_pejabat,
            'tgl_tandatangan' => $request->tgl_tandatangan,
            'lokasi' => $request->lokasi,
            'request_edit' => 'false',
            'status' => $request->status,

            'created_by' => Auth::User()->username,
            'daerah_id' => Auth::User()->daerah_id,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        return $fields;
    }

    public static function fieldAlasan($request)
    {
        $fields = [
            'alasan_unapprove' => $request->alasan,
            'request_edit' => 'reject',
            'status' => 13,
            'created_by' => Auth::User()->username,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        return $fields;
    }

    public static function fieldAlasanDoc($request)
    {
        $fields = [
            'alasan_unapprove_doc' => $request->alasan,
            'request_edit' => 'reject_doc',
            'status' => 13,
            'created_by' => Auth::User()->username,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        return $fields;
    }

    public static function fieldReqedit($request)
    {
        $fields = [
            'alasan_edit' => $request->alasan,
            'request_edit' => 'true',
            'status' => 15,
            'created_by' => Auth::User()->username,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        return $fields;
    }

    public static function fieldReqrevisi($request)
    {
        $fields = [
            'alasan_revisi' => $request->alasan,
            'request_edit' => 'revisi',
            'status' => 13,
            'created_by' => Auth::User()->username,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        return $fields;
    }

    public static function fieldLogRequest($request)
    {
        $fields = [
            'kegiatan_id' => $request->id, 
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'type' => $request->type,
            'alasan_request' => $request->alasan,
            'username' => Auth::User()->username,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => Auth::User()->name
        ];

        return $fields;
    }

    public static function Rupiah($angka)
    {

        $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');

        return $hasil_rupiah;
    }

    public static function getLabelStatus($status, $requestEdit)
    {
        if ($status === 13) {
            if ($requestEdit === "false") {
                return "Draft";
            } elseif ($requestEdit === "true") {
                return "Draft (Edit)";
            } elseif ($requestEdit === "revisi") {
                return "Draft (Revision)";
            } elseif ($requestEdit === "reject" || $requestEdit === "reject_doc") {
                return "Draft (Unapprove)";
            }
        } elseif ($status === 14) {
            if ($requestEdit === "false") {
                return "Terkirim (Waiting Approval)";
            }
        } elseif ($status === 15) {
            if ($requestEdit === "false") {
                return "Terkirim (Waiting Approval)";
            } elseif ($requestEdit === "request_doc") {
                return "Request Dokumen";
            } elseif ($requestEdit === "true") {
                return "Request Edit";
            }
        } elseif ($status === 16 && $requestEdit === "false") {
            return "Approved";
        }
        return "Label tidak ditemukan";
    }

    public static function PaguPromosi($periode_id,$daerah_id)
    {
        $data = Perencanaan::where(['periode_id'=>$periode_id,'daerah_id'=>$daerah_id])->first();
        if($data)
        {
           $result = $data->promosi_pengadaan_pagu; 
        }else{
            $result = 0;
        }   

        return $result; 


    }
}
