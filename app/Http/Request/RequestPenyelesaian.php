<?php

namespace App\Http\Request;

use DB;
use Auth;
use App\Helpers\GeneralPaginate;
use App\Helpers\GeneralHelpers;
use App\Models\Perencanaan;
use App\Models\Penyelesaian;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestDaerah;
use App\Http\Request\RequestSettingApps;
use Illuminate\Support\Facades\Validator;

class RequestPenyelesaian
{
    public static function GetDataList($request)
    {
        $temp = array();
        $temp2 = array();
        $validStatus = [13, 14, 15];
        $tahunSemester = GeneralHelpers::semesterToday();
        $getRequest = $request->all();
        $access = RequestAuth::Access();
        $column_order = ['', 'daerah_id', 'nama_kegiatan', 'sub_menu_slug', 'tgl_kegiatan', 'lokasi', 'biaya', 'status_laporan_id'];
        $column_search = ['daerah_id', 'nama_kegiatan', 'sub_menu_slug', 'tgl_kegiatan', 'lokasi', 'biaya', 'status_laporan_id'];
        $order = array('created_at' => 'ASC');

        $data = DB::table('penyelesaian');       

        if ($access == 'daerah' || $access == 'province') {
            $data->where('daerah_id', Auth()->User()->daerah_id);
        }
        
        if ($request->length > 0) {
            $data->offset($request->start)->limit($request->length);
        }

        $searchColumn = $request->input('columns');
        if (!empty($searchColumn[0]['search']['value'])) {
            $value = $searchColumn[0]['search']['value'];
            $filterjs = json_decode($value);
                        
            if (!empty($filterjs[0]->jenis_sub)) {
                $data->where('sub_menu_slug', $filterjs[0]->jenis_sub);
            }

            if (!empty($filterjs[0]->daerah_id)) {
                $data->where('daerah_id', $filterjs[0]->daerah_id);
            }

            if (in_array($filterjs[0]->search_status, $validStatus)) {
                if ($filterjs[0]->search_status_text == 'Perlu Perbaikan') {
                    $data->where('status_laporan_id', $filterjs[0]->search_status)
                        ->where('request_edit', 'reject');
                } elseif ($filterjs[0]->search_status_text == 'Draft') {
                    $data->where('status_laporan_id', $filterjs[0]->search_status)
                        ->where(function ($query) {
                            $query->where('request_edit', 'false')
                                ->orWhere('request_edit', 'true');
                        });
                } else {
                    $data->where('status_laporan_id', $filterjs[0]->search_status);
                }
            }

            if (!empty($filterjs[0]->periode_id)) {
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
        $options = RequestMenuRoles::ActionPage('penyelesaian');
        foreach ($result as $key => $val) {
            $log_url = "";
            $edit_url = "";
            $delete_url = "";
            foreach ($options as $rows => $row) {
                if ($row->action == 'update') {
                    if ($row->checked == true) 
                    {
                        if ($_COOKIE['access'] == "daerah" || $_COOKIE['access'] == "province")
                        { 
                            $edit_url =  '<div href="javascript:void(0)" id="Edit"  data-param_id=' .  $val->id . ' data-toggle="modal" data-target="#modal-add"  data-placement="top" title="Edit Data"  class="pointer btn-padding-action pull-left modalUbah"><i class="fa-icon icon-edit" ></i></div>';
                        } else {                           
                            $edit_url =  '<div href="javascript:void(0)" id="Edit"  data-param_id=' .  $val->id . ' data-toggle="modal" data-target="#modal-add"  data-placement="top" title="Detail Data"  class="pointer btn-padding-action pull-left modalUbah"><i class="fa-icon icon-detail" ></i></div>';
                        }   
                    }
                }

                if ($row->action == 'delete')
                {
                    if ($row->checked == true)
                    {
                        if ($_COOKIE['access'] == "daerah" || $_COOKIE['access'] == "province")
                        {
                            if ($val->status_laporan_id == 13 && $val->request_edit == 'false')
                            {
                                $delete_url = '<div id="Destroy" data-placement="top"  data-toggle="tooltip" title="Hapus Data" data-param_id=' .  $val->id . '  class="pointer btn-padding-action pull-left"><i class="fa-icon icon-destroy"></i> </div>';
                            }
                       }                       
                    }
                }

                if ($row->action == 'approval') {
                    if ($row->checked == true) {
                        if ($_COOKIE['access'] != "daerah" || $_COOKIE['access'] != "province") {
                            $edit_url =  '<div href="javascript:void(0)" id="Edit"  data-param_id=' .  $val->id . ' data-toggle="modal" data-target="#modal-add"  data-placement="top" title="Detail Data"  class="pointer btn-padding-action pull-left modalUbah"><i class="fa-icon icon-detail" ></i></div>';
                        }
                    }
                }

               if(!empty($val->alasan_edit) || !empty($val->alasan_edit))
               {
                   $log_url =  '<div id="Log" data-param_id=' . $val->id . ' data-toggle="modal" data-target="#modal-log"  data-toggle="tooltip" data-placement="top" title="Log Data" class="pointer btn-padding-action pull-left modalLog"><i class="fa-icon icon-detail"></i></div>';
               }
            }

            $numberNext++;
            $row   = array();
            $row[] = $val->id;
            $row[] = RequestDaerah::GetDaerahWhereID($val->daerah_id);
            $row[] = $val->nama_kegiatan;
            $row[] = $val->sub_menu;
            $row[] = GeneralHelpers::formatDate($val->tgl_kegiatan);
            $row[] = $val->lokasi;
            $row[] = GeneralHelpers::formatRupiah($val->biaya);
            $row[] = RequestPenyelesaian::getLabelStatus($val->status_laporan_id, $val->request_edit);
         
            $row[]  = '<div class="list-menu-table-penyelesaian">'.$edit_url . ' ' . $delete_url.' '.$log_url.'</div>';
            $temp[] = $row;
        }

        $temp2['data'] = $temp;
        $temp2['options'] = $options;
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

    public static function GetSumPenyelesaian($request, $id = null)
    {
        $year = substr((string)$request->periode_id_mdl, 0, 4);
        $daerah_id = Auth::user()->daerah_id;
        $sub_kegiatan = $request->sub_menu_slug;

        $query = Penyelesaian::where('daerah_id', $daerah_id)
            ->where('sub_menu_slug', $sub_kegiatan)
            ->where('periode_id', 'LIKE', $year . '%');

        if (isset($id)) {
            $query->where('id', '!=', $id);
        }

        $biayaTotal = $query->sum('biaya');
        $jmlPerusahaanTotal = $query->sum('jml_perusahaan');

        $result = [
            'biaya' => $request->biaya + $biayaTotal,
            'jml_perusahaan' => $request->jml_perusahaan + $jmlPerusahaanTotal,
        ];

        return json_decode(json_encode($result), FALSE);
    }

    public static function GetTotalPagu($request)
    {
        $tahunSemester = GeneralHelpers::semesterToday();
        $perencanaan = DB::table('perencanaan');
        $terkirim = DB::table('penyelesaian');
        $draft = DB::table('penyelesaian');
        $searchColumn = $request->data;
        if (!empty($request->data)) {
            $value = $searchColumn;
            $filterjs = json_decode($value);
            if ($filterjs[0]->periode_id) {
                $perencanaan->where('periode_id', substr($filterjs[0]->periode_id, 0, 4));
                $terkirim->where('periode_id', $filterjs[0]->periode_id);
                $draft->where('periode_id', $filterjs[0]->periode_id);
            } else {
                $perencanaan->where('periode_id', substr($tahunSemester, 0, 4));
                $terkirim->where('periode_id', $tahunSemester);
                $draft->where('periode_id', $tahunSemester);
            }
            if ($filterjs[0]->daerah_id) {
                $perencanaan->where('daerah_id', $filterjs[0]->daerah_id);
                $terkirim->where('daerah_id', $filterjs[0]->daerah_id);
                $draft->where('daerah_id', $filterjs[0]->daerah_id);
            }
        } else {
            $perencanaan->where('periode_id', substr($tahunSemester, 0, 4));
            $terkirim->where('periode_id', $tahunSemester);
            $draft->where('periode_id', $tahunSemester);
        }
        $terkirim->where('status_laporan_id', 14);
        $draft->whereNotIn('status_laporan_id', [14]);

        $temp2['total_perencanaan'] = $perencanaan->sum('penyelesaian_identifikasi_pagu') + $perencanaan->sum('penyelesaian_realisasi_pagu') + $perencanaan->sum('penyelesaian_evaluasi_pagu');
        $temp2['total_penyelesaian'] = $terkirim->sum('biaya');
        $temp2['total_draft'] = $draft->sum('biaya');

        return json_decode(json_encode($temp2), FALSE);
    }

    public static function fieldsData($request)
    {
        $subMenuMapping = [
            'identifikasi' => 'Identifikasi Penyelesaian',
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
            'alasan_revisi' => $request->alasan,
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

    public static function getLabelStatus($status, $requestEdit)
    {
        if ($status === 13) {
            if ($requestEdit === "false") {
                return "Draft";
            } elseif ($requestEdit === "true") {
                return "Draft (Edit)";
            } elseif ($requestEdit === "reject") {
                return "Perlu Perbaikan";
            }
        } elseif ($status === 14) {
            if ($requestEdit === "false") {
                return "Terkirim";
            }
        } elseif ($status === 15) {
            if ($requestEdit === "true") {
                return "Request Edit";
            }
        }
        
        return "Label tidak ditemukan";
    }
}
