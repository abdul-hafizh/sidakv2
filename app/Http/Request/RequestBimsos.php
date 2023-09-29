<?php

namespace App\Http\Request;

use Illuminate\Support\Facades\Validator;
use Auth;
use App\Helpers\GeneralPaginate;
use App\Helpers\GeneralHelpers;
use App\Models\Bimsos;
use App\Http\Request\RequestSettingApps;
use DB;

class RequestBimsos
{

    public static function GetDataList($request)
    {
        $temp = array();

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
            if ($filterjs[0]->periode_id) {
                $data->where('periode_id', $filterjs[0]->periode_id);
            }
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

            $edit_url =  '<button id="Edit"  data-param_id=' .  $val->id . ' data-toggle="modal" data-target="#modal-add" type="button" data-toggle="tooltip" data-placement="top" title="Edit Data"  class="btn btn-primary modalUbah"><i class="fa fa-pencil" ></i></button>';

            $delete_url = '<button id="Destroy" data-placement="top"  data-toggle="tooltip" title="Hapus Data" data-param_id=' .  $val->id . ' type="button" class="btn btn-primary"><i class="fa fa-trash" ></i></button>';

            $numberNext++;
            $row    = array();
            $row[]  = $val->id;

            $row[]  = $val->nama_kegiatan;
            $row[]  = RequestBimsos::getLabelSubMenu($val->sub_menu_slug);
            $row[]  = $val->tgl_bimtek;
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
            }
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
                'nama_kegiatan' => $request->nama_kegiatan,
                'tgl_bimtek' => $request->tgl_bimtek,
                'lokasi_bimtek' => $request->lokasi_bimtek,
                'biaya_kegiatan' => $request->biaya_kegiatan,
                'jml_peserta' => $request->jml_peserta,
                'ringkasan_kegiatan' => $request->ringkasan_kegiatan,

                'status_laporan_id' => '13',
                'request_edit' => 'false',
                'periode_id'  => $request->periode_id_mdl,
                'daerah_id'  => Auth::User()->daerah_id,
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
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
        if ($status === 13) {
            if ($requestEdit === "false") {
                return "Draft";
            } elseif ($requestEdit === "true") {
                return "Draft (Edit)";
            }
        } elseif ($status === 14) {
            if ($requestEdit === "false") {
                return "Terkirim";
            }
        } elseif ($status === 15) {
            if ($requestEdit === "false") {
                return "Request Revision)";
            } elseif ($requestEdit === "true") {
                return "Request Edit";
            }
        }
        return "Label tidak ditemukan";
    }
}
