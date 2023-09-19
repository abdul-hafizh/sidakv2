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
        if ($request->length > 0)
            $data->offset($request->start)->limit($request->length);

        $searchColumn = $request->columns;
        if (!empty($searchColumn[0]['search']['value'])) {
            $value = $searchColumn[0]['search']['value'];
            $filterjs = json_decode($value);

            if ($filterjs[0]->type_daerah) {
                $data->where('type_daerah', $filterjs[0]->type_daerah);
            }
            if ($filterjs[0]->daerah_id) {
                $data->where('daerah_id', $filterjs[0]->daerah_id);
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
            $row[]  = $val->sub_menu_slug;
            $row[]  = $val->tgl_bimtek;
            $row[]  = $val->lokasi_bimtek;
            $row[]  = GeneralHelpers::formatRupiah($val->biaya_kegiatan);
            $row[]  = $val->status_laporan_id;
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
        $searchColumn = $request->columns;
        if (!empty($searchColumn[0]['search']['value'])) {
            $value = $searchColumn[0]['search']['value'];
            $filterjs = json_decode($value);

            if ($filterjs[0]->type_daerah) {
                $data->where('type_daerah', $filterjs[0]->type_daerah);
            }
            if ($filterjs[0]->daerah_id) {
                $data->where('daerah_id', $filterjs[0]->daerah_id);
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

    public static function GetTotalPagu($request)
    {

        $column_search  = array('nama_daerah', 'type_daerah', 'periode_id', 'pagu_apbn', 'pagu_promosi', 'target_pengawasan', 'target_penyelesaian_permasalahan', 'target_bimbingan_teknis', 'target_video_promosi', 'pagu_dalak');

        $data = DB::table('pagu_target');
        $searchColumn = $request->data;
        if (!empty($request->data)) {
            $value = $searchColumn;
            $filterjs = json_decode($value);

            if ($filterjs[0]->type_daerah) {
                $data->where('type_daerah', $filterjs[0]->type_daerah);
            }
            if ($filterjs[0]->daerah_id) {
                $data->where('daerah_id', $filterjs[0]->daerah_id);
            }
            if ($filterjs[0]->periode_id) {
                $data->where('periode_id', $filterjs[0]->periode_id);
            }
            $i = 0;
            $search = $filterjs[0]->search_input;
            if ($filterjs[0]->search_input) {
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
        }

        $temp2['total_apbn'] = $data->sum('pagu_apbn');
        $temp2['total_promosi'] = $data->sum('pagu_promosi');

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

                'status_laporan_id' => 13,
                'request_edit' => 'false',
                'periode_id'  => '2022',
                'daerah_id'  => Auth::User()->daerah_id,
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
            ];

        return $fields;
    }
}
