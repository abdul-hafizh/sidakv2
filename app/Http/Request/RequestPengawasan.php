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

        $getRequest = $request->all();
        $column_order   = array('', 'nama_perusahaan', 'kontak', 'periode_id', 'nib', 'tgl_nib', 'no_izin_lokasi', 'tgl_izin_lokasi', 'total_rencana_inv', 'total_realisasi_inv', 'nama_kegiatan');
        $column_search   = array('nama_perusahaan', 'kontak', 'periode_id', 'nib', 'tgl_nib', 'no_izin_lokasi', 'tgl_izin_lokasi', 'total_rencana_inv', 'total_realisasi_inv', 'nama_kegiatan');

        $order = array('nama_perusahaan' => 'ASC');

        $data = DB::table('pengawasan')->offset($request->start)
            ->limit($request->length);

        if ($request->order['0']['column'] != 0) {
            $data->orderBy($column_order[$request->order['0']['column']], $request->order['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $data->orderBy(key($order), $order[key($order)]);
        }

        $numberNext = 1;
        $result = $data->get();
        foreach ($result as $key => $val) {

            $row    = array();
            $row[]  = $numberNext++;

            $row[]  = $val->nama_perusahaan;
            $row[]  = $val->kontak;
            $row[]  = $val->periode_id;
            $row[]  = $val->nib;
            $row[]  = $val->tgl_nib;
            $row[]  = $val->no_izin_lokasi;
            $row[]  = $val->tgl_izin_lokasi;
            $row[]  = $val->total_rencana_inv;
            $row[]  = $val->total_realisasi_inv;
            $row[]  = $val->nama_kegiatan;

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
                'nama_perusahaan'  => $request->username,
                'name' => $request->name,
                'nip' => $request->nip,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'phone' => $request->phone,
                'leader_name' => $request->leader_name,
                'leader_nip' => $request->leader_nip,
                'daerah_id' => $request->daerah_id,
                'created_by' => $request->username,
                'created_at' => date('Y-m-d H:i:s'),
            ];

        return $fields;
    }
}
