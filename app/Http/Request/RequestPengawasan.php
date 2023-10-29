<?php

namespace App\Http\Request;

use Illuminate\Support\Facades\Validator;
use Auth;
use App\Helpers\GeneralPaginate;
use App\Helpers\GeneralHelpers;
use App\Models\Pengawasan;
use App\Http\Request\RequestSettingApps;
use DB;

class RequestPengawasan
{

    public static function GetDataAll($data, $perPage, $request)
    {
        $temp = array();

        $getRequest = $request->all();
        $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
        $numberNext = (($page * $perPage) - ($perPage - 1));
        foreach ($data as $key => $val) {

            $temp[$key]['number'] = $numberNext++;

            $temp[$key]['id'] = $val->id;
            $temp[$key]['periode_id'] = $val->periode_id;
            $temp[$key]['daerah_id'] = $val->daerah_id;
            $temp[$key]['nama_perusahaan'] = $val->nama_perusahaan;
            $temp[$key]['kontak'] = $val->kontak;
            $temp[$key]['nib'] = $val->nib;
            $temp[$key]['tgl_nib'] = $val->tgl_nib;
            $temp[$key]['no_izin_lokasi'] = $val->no_izin_lokasi;
            $temp[$key]['tgl_izin_lokasi'] = $val->tgl_izin_lokasi;
            $temp[$key]['total_rencana_inv'] = $val->total_rencana_inv;
            $temp[$key]['total_realisasi_inv'] = $val->total_realisasi_inv;
            $temp[$key]['nama_kegiatan'] = $val->nama_kegiatan;
            $temp[$key]['created_at'] = GeneralHelpers::tanggal_indo($val['created_at']);
        }

        return json_decode(json_encode($temp), FALSE);
    }

    public static function GetDataList($request)
    {
        $temp = array();
        $tahunSemester = GeneralHelpers::semesterToday();
        $getRequest = $request->all();
        $column_order   = array('',  'sub_menu_slug', 'nama_kegiatan', 'tgl_kegiatan', 'biaya_kegiatan', 'status_laporan_id');
        $column_search  = array('sub_menu_slug', 'nama_kegiatan', 'tgl_kegiatan', 'biaya_kegiatan', 'status_laporan_id');
        $order = array('sub_menu_slug' => 'ASC');

        $data = DB::table('pengawasan');

        if ($_COOKIE['access'] == "daerah" || $_COOKIE['access'] == "province") {
            $data->where('daerah_id', Auth::User()->daerah_id);
        }

        if ($request->order['0']['column'] != 0) {
            $data->orderBy($column_order[$request->order['0']['column']], $request->order['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $data->orderBy(key($order), $order[key($order)]);
        }

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

        if ($request->length > 0)
            $data->offset($request->start)->limit($request->length);

        $numberNext = 1;
        $result = $data->get();
        foreach ($result as $key => $val) {
            $edit_url = "";
            $delete_url = "";
            $edit_url =  '<a href="javascript:void(0)" id="Edit"  data-param_id=' .  $val->id . ' data-toggle="modal" data-target="#modal-add" type="button" data-placement="top" title="Edit Data"  class="btn btn-primary modalUbah"><i class="fa fa-pencil" ></i></a>';
            if ($_COOKIE['access'] == "daerah" || $_COOKIE['access'] == "province") {
                if ($val->status_laporan_id != 14)
                    $delete_url = '<button id="Destroy" data-placement="top"  data-toggle="tooltip" title="Hapus Data" data-param_id=' .  $val->id . ' type="button" class="btn btn-primary"><i class="fa fa-trash" ></i></button>';
            }

            $row    = array();
            $row[]  = $val->id;
            $row[]  = RequestDaerah::GetDaerahWhereName($val->daerah_id);
            $row[]  = RequestPengawasan::getLabelSubMenu($val->sub_menu_slug);
            $row[]  = $val->nama_perusahaan;
            $row[]  = $val->nama_kegiatan;
            $row[]  = GeneralHelpers::formatDate($val->tgl_kegiatan);
            $row[]  = GeneralHelpers::formatRupiah($val->biaya_kegiatan);
            $row[]  = RequestPengawasan::getLabelStatus($val->status_laporan_id, $val->request_edit);
            $row[]  = $edit_url . " " . $delete_url;

            $temp[] = $row;
        }
        $temp2['data'] = $temp;
        $temp2['total'] = $data->count();
        return json_decode(json_encode($temp2), FALSE);
    }

    public static function GetDataCountFilter($request)
    {
        $temp = array();
        $tahunSemester = GeneralHelpers::semesterToday();
        $column_order   = array('',  'sub_menu_slug', 'nama_kegiatan', 'tgl_kegiatan', 'biaya_kegiatan', 'status_laporan_id');
        $column_search  = array('sub_menu_slug', 'nama_kegiatan', 'tgl_kegiatan', 'biaya_kegiatan', 'status_laporan_id');
        $order = array('sub_menu_slug' => 'ASC');

        $data = DB::table('pengawasan');
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

    public static function fieldsData($request)
    {
        $fields =
            [
                'sub_menu_slug' => $request->sub_menu_slug,
                'periode_id'  => $request->periode_id_mdl,
                'nama_kegiatan' => $request->nama_kegiatan,
                'tgl_kegiatan' => $request->tanggal_kegiatan,
                'rencana_kegiatan' => $request->hasil_analisa,
                'biaya_kegiatan' => $request->biaya,
                'lokasi_kegiatan' => $request->lokasi,
                'status_laporan_id' => $request->status,
                'request_edit' => 'false',
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
        if ($status == 'analisa')
            return  'Analisa dan Verifikasi Data';
        elseif ($status == 'inspeksi')
            return  'Inspeksi Lapangan';
        elseif ($status == 'evaluasi')
            return  'Evaluasi Penilaian Kepatuhan Pelaksanaan Perizinan Berusaha';
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
