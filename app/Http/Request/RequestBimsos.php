<?php

namespace App\Http\Request;

use Illuminate\Support\Facades\Validator;
use Auth;
use App\Helpers\GeneralPaginate;
use App\Helpers\GeneralHelpers;
use App\Models\Bimsos;
use App\Models\Perencanaan;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestDaerah;
use DB;

class RequestBimsos
{

    public static function GetDataList($request)
    {
        $temp = array();
        $tahunSemester = GeneralHelpers::semesterToday();
        $getRequest = $request->all();
        $column_order   = array('', 'nama_kegiatan', 'sub_menu_slug', 'tgl_bimtek', 'lokasi_bimtek', 'biaya_kegiatan', 'status_laporan_id');
        $column_search  = array('nama_kegiatan', 'sub_menu_slug', 'tgl_bimtek', 'lokasi_bimtek', 'biaya_kegiatan', 'status_laporan_id');
        $order = array('nama_kegiatan' => 'ASC');

        $data = DB::table('bimsos');

        if ($_COOKIE['access'] == "daerah" || $_COOKIE['access'] == "province") {
            $data->where('daerah_id', Auth::User()->daerah_id);
        }

        if ($request->length > 0)
            $data->offset($request->start)->limit($request->length);

        $searchColumn = $request->columns;
        if (!empty($searchColumn[0]['search']['value'])) {
            $value = $searchColumn[0]['search']['value'];
            $filterjs = json_decode($value);

            if ($filterjs[0]->jenis_sub) {
                $data->where('sub_menu_slug', $filterjs[0]->jenis_sub);
            }
            if ($filterjs[0]->search_status) {
                $data->where('status_laporan_id', $filterjs[0]->search_status);
            }
            if ($filterjs[0]->periode_id) {
                $data->where('periode_id', $filterjs[0]->periode_id);
            } else {
                $data->where('periode_id', $tahunSemester);
            }
            if ($filterjs[0]->daerah_id) {
                $data->where('daerah_id', $filterjs[0]->daerah_id);
            }
        } else {
            $data->where('periode_id', $tahunSemester);
        }

        $i = 0;
        $search = $request->search['value'];
        if ($request->search['value']) {
            $data->where(function ($query) use ($search, $column_search, $i) {
                foreach ($column_search as $item) {
                    if ($i == 0)
                        $query->where($item, 'LIKE', '%' . $search . '%');
                    else
                        $query->orWhere($item, 'LIKE', '%' . $search . '%');
                    $i++;
                }
            });
        }

        if ($request->order['0']['column'] != 0) {
            $data->orderBy($column_order[$request->order['0']['column']], $request->order['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $data->orderBy(key($order), $order[key($order)]);
        }

        $numberNext = 1;
        //dd($data);
        $result = $data->get();
        foreach ($result as $key => $val) {
            $edit_url = "";
            $delete_url = "";
            $edit_url =  '<a href="javascript:void(0)" id="Edit"  data-param_id=' .  $val->id . ' data-toggle="modal" data-target="#modal-add" type="button" data-placement="top" title="Edit Data"  class="btn btn-primary modalUbah"><i class="fa fa-pencil" ></i></a>';
            if ($_COOKIE['access'] == "daerah" || $_COOKIE['access'] == "province") {
                if ($val->status_laporan_id != 14)
                    $delete_url = '<button id="Destroy" data-placement="top"  data-toggle="tooltip" title="Hapus Data" data-param_id=' .  $val->id . ' type="button" class="btn btn-primary"><i class="fa fa-trash" ></i></button>';
            }

            $numberNext++;
            $row    = array();
            $row[]  = $val->id;
            $row[]  = RequestDaerah::GetDaerahWhereID($val->daerah_id);
            $row[]  = $val->nama_kegiatan;
            $row[]  = RequestBimsos::getLabelSubMenu($val->sub_menu_slug);
            $row[]  = GeneralHelpers::formatDate($val->tgl_bimtek);
            $row[]  = $val->lokasi_bimtek;
            $row[]  = GeneralHelpers::formatRupiah($val->biaya_kegiatan);
            $row[]  = RequestBimsos::getLabelStatus($val->status_laporan_id, $val->request_edit);
            $row[]  = $edit_url . " " . $delete_url;

            $temp[] = $row;
        }
        $temp2['data'] = $temp;
        $temp2['total'] = $data->count();
        $temp2['total_biaya'] = $data->sum('biaya_kegiatan');
        return json_decode(json_encode($temp2), FALSE);
    }


    public static function GetDataCountFilter($request)
    {
        $temp = array();
        $tahunSemester = GeneralHelpers::semesterToday();
        $column_order   = array('', 'nama_kegiatan', 'sub_menu_slug', 'tgl_bimtek', 'lokasi_bimtek', 'biaya_kegiatan', 'status_laporan_id');
        $column_search  = array('nama_kegiatan', 'sub_menu_slug', 'tgl_bimtek', 'lokasi_bimtek', 'biaya_kegiatan', 'status_laporan_id');
        $order = array('nama_kegiatan' => 'ASC');

        $data = DB::table('bimsos');
        if ($_COOKIE['access'] == "daerah" || $_COOKIE['access'] == "province") {
            $data->where('daerah_id', Auth::User()->daerah_id);
        }
        $searchColumn = $request->columns;
        if (!empty($searchColumn[0]['search']['value'])) {
            $value = $searchColumn[0]['search']['value'];
            $filterjs = json_decode($value);

            if ($filterjs[0]->jenis_sub) {
                $data->where('sub_menu_slug', $filterjs[0]->jenis_sub);
            }
            if ($filterjs[0]->periode_id) {
                $data->where('periode_id', $filterjs[0]->periode_id);
            } else {
                $data->where('periode_id', $tahunSemester);
            }
        } else {
            $data->where('periode_id', $tahunSemester);
        }
        $i = 0;
        $search = $request->search['value'];
        if ($request->search['value']) {
            $data->where(function ($query) use ($search, $column_search, $i) {
                foreach ($column_search as $item) {
                    if ($i == 0)
                        $query->where($item, 'LIKE', '%' . $search . '%');
                    else
                        $query->orWhere($item, 'LIKE', '%' . $search . '%');
                    $i++;
                }
            });
        }

        if ($request->order['0']['column'] != 0) {
            $data->orderBy($column_order[$request->order['0']['column']], $request->order['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $data->orderBy(key($order), $order[key($order)]);
        }

        $numberNext = 1;
        //dd($data);
        $result = $data->count();

        $temp2['total'] = $result;
        return json_decode(json_encode($temp2), FALSE);
    }

    public static function GetNilaiPerencanaan($request)
    {
        $temp = array();
        $year = substr((string)$request->periode_id_mdl, 0, 4);

        $periode = Perencanaan::where(['periode_id' => $year, 'daerah_id' => Auth::User()->daerah_id])->first();

        $temp['bimtek_perizinan_pagu'] = $periode->bimtek_perizinan_pagu;
        $temp['bimtek_pengawasan_pagu'] = $periode->bimtek_pengawasan_pagu;
        $temp['bimtek_perizinan_target'] = $periode->bimtek_perizinan_target;
        $temp['bimtek_pengawasan_target'] = $periode->bimtek_pengawasan_target;
        $temp['total_pagu'] = $periode->bimtek_perizinan_pagu + $periode->bimtek_pengawasan_pagu;
        $temp['total_peserta'] = $periode->bimtek_perizinan_target + $periode->bimtek_pengawasan_target;
        return json_decode(json_encode($temp), FALSE);
    }

    public static function GetSumBimsos($request)
    {
        $temp = array();
        $year = substr((string)$request->periode_id_mdl, 0, 4);
        $periode = Bimsos::where(['daerah_id' => Auth::User()->daerah_id, 'status_laporan_id' => 14])->where('periode_id', 'LIKE', $year . '%');

        $temp['biaya_kegiatan'] = $request->biaya_kegiatan + $periode->sum('biaya_kegiatan');
        $temp['jml_peserta'] = $request->jml_peserta + $periode->sum('jml_peserta');
        return json_decode(json_encode($temp), FALSE);
    }

    public static function fieldsData($request)
    {

        $fields =
            [
                'sub_menu_slug' => $request->sub_menu_slug,
                'nama_kegiatan' => $request->nama_kegiatan,
                'tgl_bimtek' => $request->tgl_bimtek,
                'lokasi_bimtek' => $request->lokasi_bimtek,
                'biaya_kegiatan' => $request->biaya_kegiatan,
                'jml_peserta' => $request->jml_peserta,
                'ringkasan_kegiatan' => $request->ringkasan_kegiatan,
                'status_laporan_id' => $request->status,
                'request_edit' => 'false',
                'periode_id'  => $request->periode_id_mdl,
                'daerah_id'  => Auth::User()->daerah_id,
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
            ];

        return $fields;
    }

    public static function fieldReqEdit($request)
    {
        $fields = [
            'alasan_edit' => $request->alasan,
            'request_edit' => 'true',
            'status_laporan_id' => 15,
            'modified_by' => Auth::User()->username,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        return $fields;
    }
    public static function fieldReqRevisi($request)
    {
        $fields = [
            'alasan_edit' => $request->alasan,
            'request_edit' => 'false',
            'status_laporan_id' => 15,
            'modified_by' => Auth::User()->username,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        return $fields;
    }
    public static function fieldApprEdit($request)
    {
        $fields = [
            'request_edit' => $request->request_edit,
            'status_laporan_id' => $request->status,
            'modified_by' => Auth::User()->username,
            'updated_at' => date('Y-m-d H:i:s'),
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

    public static function getLabelSubMenu($status)
    {
        if ($status == 'is_tenaga_pendamping')
            return  'Tenaga Pendamping';
        elseif ($status == 'is_bimtek_ipbbr')
            return  'Bimtek Implementasi Perizinan Berusaha Berbasis Resiko';
        elseif ($status == 'is_bimtek_ippbbr')
            return  'Bimtek Implementasi Pengawasan Perizinan Berusaha Berbasis Resiko';
        return "Label tidak ditemukan";
    }
    public static function getLabelStatus($status, $requestEdit)
    {
        if ($status == "13") {
            if ($requestEdit === "false") {
                return "Draft";
            } elseif ($requestEdit === "true") {
                return "Draft (Edit)";
            }
        } elseif ($status == "14") {
            if ($requestEdit === "false") {
                return "Terkirim";
            }
        } elseif ($status == "15") {
            if ($requestEdit === "false") {
                return "Request Revision";
            } elseif ($requestEdit === "true") {
                return "Request Edit";
            }
        }
        return "Label tidak ditemukan";
    }
}
