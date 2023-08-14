<?php

namespace App\Http\Request;

use Illuminate\Support\Facades\Validator;
use Auth;
use App\Helpers\GeneralPaginate;
use App\Helpers\GeneralHelpers;
use App\Models\PaguTarget;
use App\Http\Request\RequestSettingApps;
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
        $column_order   = array('', 'nama_daerah', 'type_daerah', 'periode_id', 'pagu_apbn', 'pagu_promosi', 'target_pengawasan', 'target_penyelesaian_permasalahan', 'target_bimbingan_teknis', 'target_video_promosi', 'pagu_dalak');
        $column_search  = array('nama_daerah', 'type_daerah', 'periode_id', 'pagu_apbn', 'pagu_promosi', 'target_pengawasan', 'target_penyelesaian_permasalahan', 'target_bimbingan_teknis', 'target_video_promosi', 'pagu_dalak');
        $order = array('nama_daerah' => 'ASC');

        $data = DB::table('pagu_target')->offset($request->start)
            ->limit($request->length);

        //  dd($request->order[0]['dir']);
       
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

            $row    = array();
            $row[]  = $numberNext++;

            $row[]  = $val->nama_daerah;
            $row[]  = $val->type_daerah;
            $row[]  = $val->periode_id;
            $row[]  = $val->pagu_apbn;
            $row[]  = $val->pagu_promosi;
            $row[]  = $val->target_pengawasan;
            $row[]  = $val->target_penyelesaian_permasalahan;
            $row[]  = $val->target_bimbingan_teknis;
            $row[]  = $val->target_video_promosi;
            $row[]  = $val->pagu_dalak;

            $temp[] = $row;
        }
        $temp2['data'] = $temp;
        $temp2['total'] = DB::table('pagu_target')->count();
        return json_decode(json_encode($temp2), FALSE);
    }




    public static function fieldsData($request)
    {

        $fields =
            [
                'periode_id'  => $request->periode_id,
                'daerah_id'  => $request->daerah_id,
                'nama_daerah'  => $request->nama_daerah,
                'pagu_apbn'  => $request->pagu_apbn,
                'pagu_promosi'  => $request->pagu_promosi,
                'type_daerah'  => $request->type_daerah,
                'target_pengawasan' => $request->target_pengawasan,
                'target_penyelesaian_permasalahan'  => $request->target_penyelesaian_permasalahan,
                'target_bimbingan_teknis'  => $request->target_bimbingan_teknis,
                'target_video_promosi'  => $request->target_video_promosi,
                'pagu_dalak'  => $request->pagu_dalak,
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
            ];

        return $fields;
    }
}
