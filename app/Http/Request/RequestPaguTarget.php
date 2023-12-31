<?php

namespace App\Http\Request;

use Illuminate\Support\Facades\Validator;
use Auth;
use App\Helpers\GeneralPaginate;
use App\Helpers\GeneralHelpers;
use App\Models\PaguTarget;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestMenuRoles;
use DB;

class RequestPaguTarget
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
            $temp[$key]['nama_daerah'] = $val->nama_daerah;
            $temp[$key]['pagu_apbn'] = $val->pagu_apbn;
            $temp[$key]['pagu_promosi'] = $val->pagu_promosi;
            $temp[$key]['type_daerah'] = $val->type_daerah;
            $temp[$key]['target_pengawasan'] = $val->target_pengawasan;
            $temp[$key]['target_penyelesaian_permasalahan'] = $val->target_penyelesaian_permasalahan;
            $temp[$key]['target_bimbingan_teknis'] = $val->target_bimbingan_teknis;
            $temp[$key]['target_video_promosi'] = $val->target_video_promosi;
            $temp[$key]['pagu_dalak'] = $val->pagu_dalak;
            $temp[$key]['created_at'] = GeneralHelpers::tanggal_indo($val['created_at']);
        }

        return json_decode(json_encode($temp), FALSE);
    }



    public static function GetDataList($request)
    {
        $temp = array();

        $getRequest = $request->all();
        $column_order   = array('', 'nama_daerah', 'type_daerah', 'periode_id', 'pagu_apbn', 'pagu_pengawasan', 'pagu_penyelesaian_permasalahan', 'pagu_bimbingan_teknis', 'pagu_promosi', 'target_pengawasan', 'target_penyelesaian_permasalahan', 'target_bimbingan_teknis', 'target_video_promosi', 'pagu_dalak');
        $column_search  = array('nama_daerah', 'type_daerah', 'periode_id', 'pagu_apbn', 'pagu_pengawasan', 'pagu_penyelesaian_permasalahan', 'pagu_bimbingan_teknis', 'pagu_promosi', 'target_pengawasan', 'target_penyelesaian_permasalahan', 'target_bimbingan_teknis', 'target_video_promosi', 'pagu_dalak');
        $order = array('nama_daerah' => 'ASC');

        $data = DB::table('pagu_target');
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
        $options = RequestMenuRoles::ActionPage('paguapbn');
        foreach ($result as $key => $val) {
            $edit_url = "";
            $delete_url = "";

            foreach ($options as $rows => $row) {
                if ($row->action == 'update') {
                    if ($row->checked == true) {
                        $edit_url =  '<div id="Edit"  data-param_id=' .  $val->id . ' data-toggle="modal" data-target="#modal-add" type="button" data-toggle="tooltip" data-placement="top" title="Edit Data"  class="pointer btn-padding-action pull-left modalUbah"><i class="fa-icon icon-edit" ></i></div>';
                    }
                }

                if ($row->action == 'delete') {
                    if ($row->checked == true) {

                        $delete_url = '<div id="Destroy" data-placement="top"  data-toggle="tooltip" title="Hapus Data" data-param_id=' .  $val->id . ' class="pointer btn-padding-action pull-left"><i class="fa-icon icon-destroy" ></i></div>';
                    }
                }
            }
            $numberNext++;
            $row    = array();
            $row[]  = $val->id;

            $row[]  = $val->nama_daerah;
            $row[]  = $val->type_daerah;
            $row[]  = $val->periode_id;
            $row[]  = GeneralHelpers::formatRupiah($val->pagu_apbn);
            $row[]  = GeneralHelpers::formatRupiah($val->pagu_pengawasan);
            $row[]  = GeneralHelpers::formatRupiah($val->pagu_penyelesaian_permasalahan);
            $row[]  = GeneralHelpers::formatRupiah($val->pagu_bimbingan_teknis);
            $row[]  = GeneralHelpers::formatRupiah($val->pagu_promosi);
            $row[]  = GeneralHelpers::formatRupiah($val->pagu_dalak);
            $row[]  = $val->target_pengawasan;
            $row[]  = $val->target_penyelesaian_permasalahan;
            $row[]  = $val->target_bimbingan_teknis;
            $row[]  = $val->target_video_promosi;

            $row[]  = '<div class="list-menu-table-pagu">' . $edit_url . " " . $delete_url . '</div>';

            $temp[] = $row;
        }
        $temp2['data'] = $temp;
        $temp2['total'] = $data->count();
        $temp2['total_apbn'] = $data->sum('pagu_apbn');
        $temp2['total_pengawasan'] = $data->sum('pagu_pengawasan');
        $temp2['total_penyelesaian_permasalahan'] = $data->sum('pagu_penyelesaian_permasalahan');
        $temp2['total_bimbingan_teknis'] = $data->sum('pagu_bimbingan_teknis');
        $temp2['total_promosi'] = $data->sum('pagu_promosi');
        $temp2['options'] = $options;
        return json_decode(json_encode($temp2), FALSE);
    }


    public static function GetDataCountFilter($request)
    {
        $temp = array();

        $column_order   = array('', 'nama_daerah', 'type_daerah', 'periode_id', 'pagu_apbn', 'pagu_pengawasan', 'pagu_penyelesaian_permasalahan', 'pagu_bimbingan_teknis', 'pagu_promosi', 'target_pengawasan', 'target_penyelesaian_permasalahan', 'target_bimbingan_teknis', 'target_video_promosi', 'pagu_dalak');
        $column_search  = array('nama_daerah', 'type_daerah', 'periode_id', 'pagu_apbn', 'pagu_pengawasan', 'pagu_penyelesaian_permasalahan', 'pagu_bimbingan_teknis', 'pagu_promosi', 'target_pengawasan', 'target_penyelesaian_permasalahan', 'target_bimbingan_teknis', 'target_video_promosi', 'pagu_dalak');
        $order = array('nama_daerah' => 'ASC');

        $data = DB::table('pagu_target');
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

        $column_search  = array('nama_daerah', 'type_daerah', 'periode_id', 'pagu_apbn', 'pagu_pengawasan', 'pagu_penyelesaian_permasalahan', 'pagu_bimbingan_teknis', 'pagu_promosi', 'target_pengawasan', 'target_penyelesaian_permasalahan', 'target_bimbingan_teknis', 'target_video_promosi', 'pagu_dalak');

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
        $temp2['total_pengawasan'] = $data->sum('pagu_pengawasan');
        $temp2['total_penyelesaian_permasalahan'] = $data->sum('pagu_penyelesaian_permasalahan');
        $temp2['total_bimbingan_teknis'] = $data->sum('pagu_bimbingan_teknis');


        return json_decode(json_encode($temp2), FALSE);
    }



    public static function fieldsData($request)
    {

        $fields =
            [
                'periode_id'  => $request->periode_id,
                'daerah_id'  => $request->daerah_id,
                'nama_daerah'  => $request->nama_daerah,
                'pagu_apbn'  => $request->pagu_pengawasan + $request->pagu_penyelesaian_permasalahan + $request->pagu_bimbingan_teknis,
                'pagu_promosi'  => $request->pagu_promosi,
                'type_daerah'  => $request->type_daerah,
                'pagu_pengawasan' => $request->pagu_pengawasan,
                'pagu_penyelesaian_permasalahan'  => $request->pagu_penyelesaian_permasalahan,
                'pagu_bimbingan_teknis'  => $request->pagu_bimbingan_teknis,
                'target_pengawasan' => $request->target_pengawasan,
                'target_penyelesaian_permasalahan'  => $request->target_penyelesaian_permasalahan,
                'target_bimbingan_teknis'  => $request->target_bimbingan_teknis,
                'target_video_promosi'  => $request->target_video_promosi,
                'pagu_dalak'  => $request->pagu_pengawasan + $request->pagu_penyelesaian_permasalahan + $request->pagu_bimbingan_teknis + $request->pagu_promosi,
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
            ];

        return $fields;
    }
}
