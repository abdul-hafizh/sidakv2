<?php

namespace App\Http\Request;

use DB;
use Auth;
use App\Helpers\GeneralPaginate;
use App\Helpers\GeneralHelpers;
use App\Models\Perencanaan;
use App\Models\Penyelesaian;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestSettingApps;
use Illuminate\Support\Facades\Validator;

class RequestPenyelesaian
{
    public static function GetDataList($request)
    {
        $temp = array();
        $temp2 = array();
        $tahunSemester = GeneralHelpers::semesterToday();
        $getRequest = $request->all();
        $access = RequestAuth::Access();
        $column_order = ['', 'nama_kegiatan', 'sub_menu_slug', 'tgl_kegiatan', 'lokasi', 'biaya', 'status_laporan_id'];
        $column_search = ['nama_kegiatan', 'sub_menu_slug', 'tgl_kegiatan', 'lokasi', 'biaya', 'status_laporan_id'];
        $order = ['created_date' => 'DESC'];

        $data = DB::table('penyelesaian');       

        if ($access == 'daerah' || $access == 'province') {
            $data->where('daerah_id', Auth()->User()->daerah_id);
        }

        if ($request->filled('length')) {
            $data->offset($request->input('start'))->limit($request->input('length'));
        }

        $searchColumn = $request->input('columns');
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

        $searchValue = $request->input('search.value');
        if ($searchValue) {
            $data->where(function ($query) use ($searchValue, $column_search) {
                foreach ($column_search as $item) {
                    $query->orWhere($item, 'LIKE', '%' . $searchValue . '%');
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
        $result = $data->get();

        foreach ($result as $key => $val) {
            $edit_url = "";
            $delete_url = "";
            $edit_url =  '<button id="Edit"  data-param_id=' .  $val->id . ' data-toggle="modal" data-target="#modal-add" type="button" data-toggle="tooltip" data-placement="top" title="Edit Data"  class="btn btn-primary modalUbah"><i class="fa fa-pencil" ></i></button>';
            $delete_url = '<button id="Destroy" data-placement="top"  data-toggle="tooltip" title="Hapus Data" data-param_id=' .  $val->id . ' type="button" class="btn btn-primary"><i class="fa fa-trash" ></i></button>';

            $numberNext++;
            $row   = array();
            $row[] = $val->id;
            $row[] = $val->nama_kegiatan;
            $row[] = $val->sub_menu;
            $row[] = GeneralHelpers::formatDate($val->tgl_kegiatan);
            $row[] = $val->lokasi;
            $row[] = GeneralHelpers::formatRupiah($val->biaya);
            $row[] = RequestPenyelesaian::getLabelStatus($val->status_laporan_id, $val->request_edit);
            $row[] = $edit_url . " " . $delete_url;

            $temp[] = $row;
        }

        $temp2['data'] = $temp;
        $temp2['total'] = $data->count();
        $temp2['total_biaya'] = $data->sum('biaya');

        return json_decode(json_encode($temp2), FALSE);
    }

    public static function GetDataCountFilter($request)
    {
        $temp = array();
        $temp2 = array();
        $access = RequestAuth::Access();
        $tahunSemester = GeneralHelpers::semesterToday();
        $column_order  = array('', 'nama_kegiatan', 'sub_menu_slug', 'tgl_kegiatan', 'lokasi', 'biaya', 'status_laporan_id');
        $column_search = array('nama_kegiatan', 'sub_menu_slug', 'tgl_kegiatan', 'lokasi', 'biaya', 'status_laporan_id');
        $order = array('nama_kegiatan' => 'ASC');

        $data = DB::table('penyelesaian');

        if ($access == "daerah" || $access == "province") {
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
        $result = $data->count();
        $temp2['total'] = $result;

        return json_decode(json_encode($temp2), FALSE);
    }

    public static function GetNilaiPerencanaan($request)
    {
        $temp = array();
        $year = substr((string)$request->periode_id_mdl, 0, 4);

        $periode = Perencanaan::where(['periode_id' => $year, 'daerah_id' => Auth::User()->daerah_id])->first();

        $temp['penyelesaian_identifikasi_pagu'] = $periode->penyelesaian_identifikasi_pagu;
        $temp['penyelesaian_realisasi_pagu'] = $periode->penyelesaian_realisasi_pagu;
        $temp['penyelesaian_evaluasi_pagu'] = $periode->penyelesaian_evaluasi_pagu;
        $temp['penyelesaian_identifikasi_target'] = $periode->penyelesaian_identifikasi_target;
        $temp['penyelesaian_realisasi_target'] = $periode->penyelesaian_realisasi_target;
        $temp['penyelesaian_evaluasi_target'] = $periode->penyelesaian_evaluasi_target;
        
        $temp['total_pagu'] = $periode->penyelesaian_identifikasi_pagu + $periode->penyelesaian_realisasi_pagu + $periode->penyelesaian_evaluasi_pagu;
        $temp['total_target'] = $periode->penyelesaian_identifikasi_target + $periode->penyelesaian_realisasi_target + $periode->penyelesaian_evaluasi_target;

        return json_decode(json_encode($temp), FALSE);
    }

    public static function GetSumPenyelesaian($request)
    {
        $year = substr((string)$request->periode_id_mdl, 0, 4);
        $daerah_id = Auth::user()->daerah_id;
        $status_laporan_id = 14;

        $biayaTotal = Penyelesaian::where('daerah_id', $daerah_id)
            ->where('status_laporan_id', $status_laporan_id)
            ->where('periode_id', 'LIKE', $year . '%')
            ->sum('biaya');

        $jmlPerusahaanTotal = Penyelesaian::where('sub_menu_slug', 'penyelesaian')
            ->where('daerah_id', $daerah_id)
            ->where('status_laporan_id', $status_laporan_id)
            ->where('periode_id', 'LIKE', $year . '%')
            ->sum('jml_perusahaan');

        $temp = [
            'biaya' => $request->biaya + $biayaTotal,
            'jml_perusahaan' => $request->jml_perusahaan + $jmlPerusahaanTotal,
        ];

        return json_decode(json_encode($temp), FALSE);
    }

    public static function fieldsData($request)
    {
        $subMenuMapping = [
            'identidikasi' => 'Identifikasi Penyelesaian',
            'penyelesaian' => 'Penyelesaian Masalah',
            'evaluasi' => 'Evaluasi Penyelesaian',
        ];
    
        $jenis = $subMenuMapping[$request->sub_menu_slug] ?? '';

        $fields =
            [
                'sub_menu' => $jenis,
                'sub_menu_slug' => $request->sub_menu_slug,
                'nama_kegiatan' => $request->nama_kegiatan,
                'tgl_kegiatan' => $request->tgl_kegiatan,
                'lokasi' => $request->lokasi,
                'biaya' => $request->biaya,
                'jml_perusahaan' => $request->jml_perusahaan,
                'status_laporan_id' => $request->status == 14 ? 14 : 13,
                'request_edit' => 'false',
                'periode_id' => $request->periode_id_mdl,
                'daerah_id' => Auth::User()->daerah_id,
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
            ];

        return $fields;
    }

    public static function fieldReqEdit($request)
    {
        $fields = [
            'alasan_edit' => $request->alasan_edit,
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
            'alasan_revisi' => $request->alasan_revisi,
            'request_edit' => 'reject',
            'status_laporan_id' => 13,
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

    public static function getLabelStatus($status, $requestEdit)
    {
        if ($status === 13) {
            if ($requestEdit === "false") {
                return "Draft";
            } elseif ($requestEdit === "true") {
                return "Draft (Edit)";
            } elseif ($requestEdit === "revisi") {
                return "Draft (Revision)";
            } elseif ($requestEdit === "reject") {
                return "Perlu Perbaikan";
            }
        } elseif ($status === 14) {
            if ($requestEdit === "false") {
                return "Terkirim";
            }
        } elseif ($status === 15) {
            if ($requestEdit === "false") {
                return "Terkirim";
            } elseif ($requestEdit === "true") {
                return "Request Edit";
            }
        } elseif ($status === 16 && $requestEdit === "false") {
            return "Approved";
        }
        return "Label tidak ditemukan";
    }
}
