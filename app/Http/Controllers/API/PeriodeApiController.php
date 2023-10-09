<?php

namespace App\Http\Controllers\API;

use DB;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periode;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestPeriode;
use App\Http\Request\Validation\ValidationPeriode;
use App\Http\Request\RequestAuditLog;
use App\Helpers\GeneralHelpers;
use App\Helpers\GeneralPaginate;

class PeriodeApiController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $query = Periode::orderBy('created_at', 'DESC');
        if ($request->per_page != 'all') {
            $data = $query->paginate($request->per_page);
        } else {
            $data = $query->get();
        }

        $result = RequestPeriode::GetDataAll($data, $request->per_page, $request);
        return response()->json($result);
    }

    public function listAll(Request $request)
    {
        $access = RequestAuth::Access();

        $query =  DB::table('periode as a');

        if ($access == 'daerah' ||  $access == 'province') {
              $query->select('a.id', 'a.slug', 'a.year', 'c.pagu_apbn', 'c.pagu_promosi', 'c.target_pengawasan', 'c.target_bimbingan_teknis', 'c.target_penyelesaian_permasalahan');
            $query->where('c.daerah_id', Auth::User()->daerah_id);

            if ($request->type == 'POST' && $request->action == 'perencanaan') {
                $query->whereNotIn(
                    'year',
                    DB::table('perencanaan')
                        ->select('periode_id')->where('daerah_id', Auth::User()->daerah_id)
                );
            } else if($request->type == 'GET' && $request->action == 'perencanaan') {
                $query->whereIn(
                    'year',
                    DB::table('perencanaan')
                        ->select('periode_id')->where('daerah_id', Auth::User()->daerah_id)
                );
            }else if ($request->type == 'POST' && $request->action == 'pengawasan') {
                $query->whereNotIn(
                    'year',
                    DB::table('pengawasan')
                        ->select('periode_id')->where('slug', Auth::User()->daerah_id)
                );
            }else if($request->type == 'GET' && $request->action == 'pengawasan') {
                $query->whereIn(
                    'year',
                    DB::table('pengawasan')
                        ->select('periode_id')->where('daerah_id', Auth::User()->daerah_id)
                );

            }else if ($request->type == 'POST' && $request->action == 'bimsos') {
                $query->whereNotIn(
                    'year',
                    DB::table('bimsos')
                        ->select('periode_id')->where('daerah_id', Auth::User()->daerah_id)
                );
            }else if($request->type == 'GET' && $request->action == 'bimsos') {
                $query->whereIn(
                    'year',
                    DB::table('bimsos')
                        ->select('periode_id')->where('daerah_id', Auth::User()->daerah_id)
                );

            }else if ($request->type == 'POST' && $request->action == 'penyelesaian') {
                $query->whereNotIn(
                    'year',
                    DB::table('penyelesaian')
                        ->select('periode_id')->where('daerah_id', Auth::User()->daerah_id)
                );
            }else if($request->type == 'GET' && $request->action == 'penyelesaian') {
                $query->whereIn(
                    'year',
                    DB::table('penyelesaian')
                        ->select('periode_id')->where('daerah_id', Auth::User()->daerah_id)
                );

            }else if ($request->type == 'POST' && $request->action == 'promosi') {
                $query->whereNotIn(
                    'year',
                    DB::table('promosi')
                        ->select('periode_id')->where('daerah_id', Auth::User()->daerah_id)
                );
            }else if($request->type == 'GET' && $request->action == 'promosi') {
                $query->whereIn(
                    'year',
                    DB::table('promosi')
                        ->select('periode_id')->where('daerah_id', Auth::User()->daerah_id)
                );

            }

            $query->join('pagu_target as c', 'a.year', '=', 'c.periode_id')->groupBy('year');
              

        } else {
            $query->select('a.id', 'a.slug', 'a.year');
            $query->groupBy('a.year');
        }
       
        $query->where('a.status', 'Y');
        $data = $query->get();
        if ($data->count() != 0) {
            $selected = false;
        } else {
            $selected = true;
        }

        $periode = RequestPeriode::SelectAll($data, $request->type,$request->action);
        return response()->json(['selected' => $selected, 'result' => $periode]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $_res = array();
        $column_search  = array('name', 'slug', 'year');

        $i = 0;
        $query  = Periode::orderBy('id', 'DESC');
        foreach ($column_search as $item) {
            if ($search) {
                if ($i === 0) {
                    $query->where($item, 'LIKE', '%' . $search . '%');
                } else {
                    $query->orWhere($item, 'LIKE', '%' . $search . '%');
                }
            }
            $i++;
        }

        $data = $query->paginate($request->per_page);
        $description = $search;

        $_res = RequestPeriode::GetDataAll($data, $request->per_page, $request, $description);
        return response()->json($_res);
    }

    public function edit($id)
    {
        $Data = Periode::find($id);
        $_res = RequestPeriode::GetDataID($Data);
        return response()->json($_res);
    }

    public function store(Request $request)
    {
        $validation = ValidationPeriode::validationInsert($request);
        if ($validation) {
            return response()->json($validation, 400);
        } else {

            $check = Periode::where(['slug' => $request->year . $request->semester])->first();
            if ($check) {


                $err['messages']['semester'] = 'Semester dan tahun sudah pernah dibuat.';
                $err['messages']['year'] = 'Semester dan tahun sudah pernah dibuat.';


                return response()->json($err, 400);
            } else {
                $insert = RequestPeriode::fieldsData($request);
                if ($request->semester == '01') {
                    $name = 'Semester 1 Tahun ' . $request->year;
                } else {
                    $name = 'Semester 2 Tahun ' . $request->year;
                }

                $log = array(
                    'category' => 'LOG_DATA_PERIODE',
                    'group_menu' => 'upload_data_periode',
                    'description' => 'Menambahkan data periode <b>' . $name . '</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);

                //create menu
                $saveData = Periode::create($insert);
                //result
                return response()->json(['status' => true, 'id' => $saveData, 'message' => 'Insert data sucessfully']);
            }
        }
    }

    public function update($id, Request $request)
    {
        $validation = ValidationPeriode::validationUpdate($request, $id);
        if ($validation) {
            return response()->json($validation, 400);
        } else {

            if ($request->semester == '01') {
                $name = 'Semester 1 Tahun ' . $request->year;
            } else {
                $name = 'Semester 2 Tahun ' . $request->year;
            }

            $update = RequestPeriode::fieldsData($request);
            $check = Periode::where(['slug' => $request->year . $request->semester, 'id' => $id])->first();

            if ($check) {
                $UpdateData = Periode::where('id', $id)->update($update);


                $log = array(
                    'category' => 'LOG_DATA_PERIODE',
                    'group_menu' => 'mengubah_data_periode',
                    'description' => 'Mengubah data periode <b>' . $name . '</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);
                //Audit Log
            } else {

                $checklain = Periode::where(['slug' => $request->year . $request->semester])->first();
                if ($checklain) {
                    $err['messages']['semester'] = 'Semester dan tahun sudah pernah dibuat.';
                    $err['messages']['year'] = 'Semester dan tahun sudah pernah dibuat.';
                    return response()->json($err, 400);
                } else {



                    $log = array(
                        'category' => 'LOG_DATA_PERIODE',
                        'group_menu' => 'mengubah_data_periode',
                        'description' => 'Mengubah data periode <b>' . $name . '</b>',
                    );
                    $datalog = RequestAuditLog::fieldsData($log);
                    //Audit Log

                    $UpdateData = Periode::where('id', $id)->update($update);
                }
            }

            return response()->json(['status' => true, 'id' => $UpdateData, 'message' => 'Update data sucessfully']);
        }
    }

    public function delete($id)
    {
        $messages['messages'] = false;
        $_res = Periode::find($id);
        if ($_res->semester == '01') {
            $name = 'Semester 1 Tahun ' . $_res->year;
        } else {
            $name = 'Semester 2 Tahun ' . $_res->year;
        }

        $log = array(
            'category' => 'LOG_DATA_PERIODE',
            'group_menu' => 'menghapus_data_periode',
            'description' => '<b>' . $name . '</b> telah dihapus',
        );
        $datalog = RequestAuditLog::fieldsData($log);

        if (empty($_res)) {
            return response()->json(['messages' => false]);
        }

        $results = $_res->delete();
        if ($results) {
            $messages['messages'] = true;
        }
        return response()->json($messages);
    }

    public function deleteSelected(Request $request)
    {
        $messages['messages'] = false;

        $json = json_encode($request->data);
        //Audit Log
        $log = array(
            'action' => 'Delete Periode Select',
            'slug' => 'delete-periode-select',
            'type' => 'post',
            'json_field' => $json,
            'url' => 'api/periode/selected/'
        );

        RequestAuditLog::fieldsData($log);

        foreach ($request->data as $key) {
            $find = Periode::where('id', $key)->first();
            if ($find->semester == '01') {
                $name = 'Semester 1 Tahun ' . $find->year;
            } else {
                $name = 'Semester 2 Tahun ' . $find->year;
            }

            $log = array(
                'category' => 'LOG_DATA_PERIODE',
                'group_menu' => 'menghapus_data_periode',
                'description' => '<b>' . $name . '</b> telah dihapus',
            );
            // $datalog = RequestAuditLog::fieldsData($log);
            $results = Periode::where('id', (int)$key)->delete();
        }

        if ($results) {
            $messages['messages'] = true;
        }

        return response()->json($messages);
    }

    
    public function listAllSemester(Request $request)
    {
        $access = RequestAuth::Access();
        $tahunSemester = GeneralHelpers::semesterToday();
        $query =  DB::table('periode as a')
            ->select('a.id', 'a.slug', 'a.name')
            ->where('a.status', 'Y')
            ->groupBy('slug');

        if ($access == 'daerah' ||  $access == 'province') {

            $query->whereIn(
                'year',
                DB::table('perencanaan')
                    ->select('periode_id')->where('daerah_id', Auth::User()->daerah_id)                    
            );
        }

        $data = $query->get();

        $periode = RequestPeriode::SelectAllSemester($data);
        $output = array(
            "tahunSemester" => $tahunSemester,
            "periode" => $periode,
        );
        return response()->json($output);
    }
}
