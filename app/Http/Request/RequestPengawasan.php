<?php

namespace App\Http\Request;

use Illuminate\Support\Facades\Validator;
use Auth;
use App\Helpers\GeneralPaginate;
use App\Helpers\GeneralHelpers;
use App\Models\Pengawasan;
use App\Models\Perencanaan;
use App\Http\Request\RequestMenuRoles;
use App\Http\Request\RequestSettingApps;
use Illuminate\Support\Str;
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

            if($val->nama_perusahaan ==null)
            {
                $nama_perusahaan = '';
            }else{
               $nama_perusahaan = $val->nama_perusahaan;
            }    

            $temp[$key]['number'] = $numberNext++;

            $temp[$key]['id'] = $val->id;
            $temp[$key]['periode_id'] = $val->periode_id;
            $temp[$key]['daerah_id'] = $val->daerah_id;
            $temp[$key]['nama_perusahaan'] =  $nama_perusahaan;
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

        $data = DB::table('pengawasan')->select('pengawasan.*', DB::raw('GROUP_CONCAT(pengawasan_perusahaan.nama_perusahaan) as nama_prshn'))->leftJoin('pengawasan_perusahaan', 'pengawasan.id', '=', 'pengawasan_perusahaan.pengawasan_id')->groupBy('pengawasan.id');

        if ($_COOKIE['access'] == "daerah" || $_COOKIE['access'] == "province") {
            $data->where('daerah_id', Auth::User()->daerah_id);
        }

        // if ($request->order['0']['column'] != 0) {
        //     $data->orderBy($column_order[$request->order['0']['column']], $request->order['0']['dir']);
        // } else if (isset($order)) {
        $order = $order;
        $data->orderBy(key($order), $order[key($order)]);
        // }

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
        $options = RequestMenuRoles::ActionPage('pengawasan');

        foreach ($result as $key => $val) {
            $edit_url = "";
            $delete_url = "";
            //    $edit_url =  '<div id="Edit"  data-param_id=' .  $val->id . ' data-toggle="modal" data-target="#modal-add" type="button" data-toggle="tooltip" data-placement="top" title="Edit Data"  class="pointer btn-padding-action pull-left modalUbah"><i class="fa-icon icon-edit" ></i></div>';


            foreach ($options as $rows => $row) {
                if ($row->action == 'update') {
                    if ($row->checked == true) {

                        if ($_COOKIE['access'] == "daerah" || $_COOKIE['access'] == "province") {

                            $edit_url =  '<div href="javascript:void(0)" id="Edit"  data-param_id=' .  $val->id . ' data-toggle="modal" data-target="#modal-add"  data-placement="top" title="Edit Data"  class="pointer btn-padding-action pull-left modalUbah"><i class="fa-icon icon-edit" ></i></div>';
                        }
                    }
                }

                if ($row->action == 'delete') {
                    if ($row->checked == true) {
                        if ($_COOKIE['access'] == "daerah" || $_COOKIE['access'] == "province") {
                            if ($val->status_laporan_id != 14)
                                $delete_url = '<div id="Destroy" data-placement="top"  data-toggle="tooltip" title="Hapus Data" data-param_id=' .  $val->id . ' class="pointer btn-padding-action pull-left"><i class="fa-icon icon-destroy" ></i></div>';
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
            }

            if($val->nama_prshn ==null){
               $perusahaan = '';
            }else{ 
               $perusahaan =$val->nama_prshn; 
            }

            $row    = array();
            $row[]  = $val->id;
            $row[]  = RequestDaerah::GetDaerahWhereID($val->daerah_id);
            $row[]  = RequestPengawasan::getLabelSubMenu($val->sub_menu_slug);
            $row[]  = $perusahaan;
            $row[]  = $val->nama_kegiatan;
            $row[]  = GeneralHelpers::formatDate($val->tgl_kegiatan);
            $row[]  = GeneralHelpers::formatRupiah($val->biaya_kegiatan);
            $row[]  = RequestPengawasan::getLabelStatus($val->status_laporan_id, $val->request_edit);
            $row[]  = '<div class="list-menu-table-pagu">' . $edit_url . " " . $delete_url . '</div>';

            $temp[] = $row;
        }
        $temp2['data'] = $temp;
        $temp2['options'] = $options;
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

        // if ($request->order['0']['column'] != 0) {
        //     $data->orderBy($column_order[$request->order['0']['column']], $request->order['0']['dir']);
        // } else if (isset($order)) {
        $order = $order;
        $data->orderBy(key($order), $order[key($order)]);
        // }

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

        $temp['pengawas_analisa_pagu'] = $periode->pengawas_analisa_pagu;
        $temp['pengawas_inspeksi_pagu'] = $periode->pengawas_inspeksi_pagu;
        $temp['pengawas_evaluasi_pagu'] = $periode->pengawas_evaluasi_pagu;
        $temp['pengawas_analisa_target'] = $periode->pengawas_analisa_target;
        $temp['pengawas_inspeksi_target'] = $periode->pengawas_inspeksi_target;
        $temp['pengawas_evaluasi_target'] = $periode->pengawas_evaluasi_target;
        $temp['total_pagu'] = $periode->pengawas_analisa_pagu + $periode->pengawas_inspeksi_pagu + $periode->pengawas_evaluasi_pagu;
        $temp['total_target'] = $periode->pengawas_analisa_target + $periode->pengawas_inspeksi_target + $periode->pengawas_evaluasi_target;
        return json_decode(json_encode($temp), FALSE);
    }

    public static function GetSumPengawasan($request)
    {
        $temp = array();
        $year = substr((string)$request->periode_id_mdl, 0, 4);
        $slug = $request->sub_menu_slug;
        $periode = Pengawasan::where(['daerah_id' => Auth::User()->daerah_id, 'status_laporan_id' => 14, 'sub_menu_slug' => $slug])->where('periode_id', 'LIKE', $year . '%');

        $temp['biaya_kegiatan'] = $request->biaya + $periode->sum('biaya_kegiatan');
        $temp['jml_target'] = 1 + $periode->count();
        return json_decode(json_encode($temp), FALSE);
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

    public static function fieldsDataPerusahaan($request, $id)
    {
        $data_perusahaan = [];
        foreach ($request->nib as $key => $v) {
            $data_perusahaan[$key] = [
                'id' => Str::uuid()->toString(),
                'pengawasan_id' => $id,
                'lokasi_kegiatan' => $request->lokasi_perusahaan[$key],
                'nama_perusahaan' => $request->nama_perusahaan[$key],
                'kontak' => $request->kontak[$key],
                'nib' => $request->nib[$key],
                'tgl_nib' => $request->tgl_nib[$key],
                'no_izin_lokasi' => $request->no_izin_lokasi[$key],
                'tgl_izin_lokasi' => $request->tgl_izin_lokasi[$key],
                'no_izin_amdal' => $request->no_izin_amdal[$key],
                'tgl_izin_amdal' => $request->tgl_izin_amdal[$key],
                'no_izin_lingkungan' => $request->no_izin_lingkungan[$key],
                'tgl_izin_lingkungan' => $request->tgl_izin_lingkungan[$key],
                'no_imb' => $request->no_imb[$key],
                'tgl_imb' => $request->tgl_imb[$key],
                'total_rencana_inv' => $request->total_rencana_inv[$key],
                'total_realisasi_inv' => $request->total_realisasi_inv[$key],
                'rencana_tki' => $request->rencana_tki[$key],
                'realisasi_tki' => $request->realisasi_tki[$key],
                'rencana_tka' => $request->rencana_tka[$key],
                'realisasi_tka' => $request->realisasi_tka[$key],
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $path = 'pengawasan/' . $request->periode_id_mdl . '/' . Auth::User()->daerah_id;

            if ($request->hasFile('lap_evaluasi.' . $key)) {
                $file_evaluasi = $request->file('lap_evaluasi')[$key];
                $lap_evaluasi = 'kepatuhan-' . time() . '_' . $file_evaluasi->getClientOriginalName();
                $file_evaluasi->move(public_path($path), $lap_evaluasi);
                $data_perusahaan[$key]['lap_evaluasi'] = $path . '/' . $lap_evaluasi;
            } else {
                $data_perusahaan[$key]['lap_evaluasi'] = $request->lap_evaluasi_file[$key];
            }
            if ($request->hasFile('lap_lkpm.' . $key)) {
                $file_lkpm = $request->file('lap_lkpm')[$key];
                $lap_lkpm = 'lkpm-' . time() . '-' . $file_lkpm->getClientOriginalName();
                $file_lkpm->move(public_path($path), $lap_lkpm);

                $data_perusahaan[$key]['lap_lkpm'] = $path . '/'  . $lap_lkpm;
            } else {
                $data_perusahaan[$key]['lap_lkpm'] = $request->lap_lkpm_file[$key];
            }
            if ($request->hasFile('lap_bap.' . $key)) {
                $file_bap = $request->file('lap_bap')[$key];
                $lap_bap = 'bap-' . time() . '-' . $file_bap->getClientOriginalName();
                $file_bap->move(public_path($path), $lap_bap);

                $data_perusahaan[$key]['lap_bap'] = $path . '/'  . $lap_bap;
            } else {
                $data_perusahaan[$key]['lap_bap'] = $request->lap_bap_file[$key];
            }
            if ($request->hasFile('lap_profile.' . $key)) {
                $file_profile = $request->file('lap_profile')[$key];
                $lap_profile = 'profile-' . time() . '-' . $file_profile->getClientOriginalName();
                $file_profile->move(public_path($path), $lap_profile);

                $data_perusahaan[$key]['lap_profile'] = $path . '/'  . $lap_profile;
            } else {
                $data_perusahaan[$key]['lap_profile'] = $request->lap_profile_file[$key];
            }
        }
        return $data_perusahaan;
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

    public static function GetTotalPagu($request)
    {

        $tahunSemester = GeneralHelpers::semesterToday();

        $perencanaan = DB::table('perencanaan');
        $pengawasan_terkirim = DB::table('pengawasan');
        $pengawasan_draft = DB::table('pengawasan');
        $searchColumn = $request->data;
        if (!empty($request->data)) {
            $value = $searchColumn;
            $filterjs = json_decode($value);
            if ($filterjs[0]->periode_id) {
                $perencanaan->where('periode_id', substr($filterjs[0]->periode_id, 0, 4));
                $pengawasan_terkirim->where('periode_id', $filterjs[0]->periode_id);
                $pengawasan_draft->where('periode_id', $filterjs[0]->periode_id);
            } else {
                $perencanaan->where('periode_id', substr($tahunSemester, 0, 4));
                $pengawasan_terkirim->where('periode_id', $tahunSemester);
                $pengawasan_draft->where('periode_id', $tahunSemester);
            }
            if ($filterjs[0]->daerah_id) {
                $perencanaan->where('daerah_id', $filterjs[0]->daerah_id);
                $pengawasan_terkirim->where('daerah_id', $filterjs[0]->daerah_id);
                $pengawasan_draft->where('daerah_id', $filterjs[0]->daerah_id);
            }
        } else {
            $perencanaan->where('periode_id', substr($tahunSemester, 0, 4));
            $pengawasan_terkirim->where('periode_id', $tahunSemester);
            $pengawasan_draft->where('periode_id', $tahunSemester);
        }
        $pengawasan_terkirim->where('status_laporan_id', 14);
        $pengawasan_draft->whereNotIn('status_laporan_id', [14]);

        $temp2['total_perencanaan'] = $perencanaan->sum('pengawas_analisa_pagu') + $perencanaan->sum('pengawas_inspeksi_pagu') + $perencanaan->sum('pengawas_evaluasi_pagu');
        $temp2['total_pengawasan'] = $pengawasan_terkirim->sum('biaya_kegiatan');
        $temp2['total_pengawasan_draft'] = $pengawasan_draft->sum('biaya_kegiatan');

        return json_decode(json_encode($temp2), FALSE);
    }
}
