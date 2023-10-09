<?php

namespace App\Http\Controllers\API;

use DB;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Extension;
use App\Http\Request\RequestAuth;
use App\Http\Request\RequestExtension;
use App\Http\Request\Validation\ValidationExtension;
use App\Http\Request\RequestAuditLog;
use App\Helpers\GeneralHelpers;
use App\Helpers\GeneralPaginate;

class ExtensionApiController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $query = Extension::orderBy('created_at', 'DESC');
        if ($request->per_page != 'all') {
            $data = $query->paginate($request->per_page);
        } else {
            $data = $query->get();
        }

        $result = RequestExtension::GetDataAll($data, $request->per_page, $request);
        return response()->json($result);
    }

    
    public function search(Request $request)
    {
        $search = $request->search;
        $_res = array();
        $column_search  = array('name', 'slug', 'year');

        $i = 0;
        $query  = Extension::orderBy('id', 'DESC');
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

        $_res = RequestExtension::GetDataAll($data, $request->per_page, $request, $description);
        return response()->json($_res);
    }

    

    public function store(Request $request)
    {
        $validation = ValidationExtension::validationInsert($request);
        if ($validation) {
            return response()->json($validation, 400);
        } else {

            $check = Extension::where(['slug' => $request->year . $request->semester])->first();
            if ($check) {


                $err['messages']['semester'] = 'Semester dan tahun sudah pernah dibuat.';
                $err['messages']['year'] = 'Semester dan tahun sudah pernah dibuat.';


                return response()->json($err, 400);
            } else {
                $insert = RequestExtension::fieldsData($request);
                if ($request->semester == '01') {
                    $name = 'Semester 1 Tahun ' . $request->year;
                } else {
                    $name = 'Semester 2 Tahun ' . $request->year;
                }

                $log = array(
                    'category' => 'LOG_DATA_PERIODE_EXTENSION',
                    'group_menu' => 'upload_data_periode',
                    'description' => 'Menambahkan data Extension <b>' . $name . '</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);

                //create menu
                $saveData = Extension::create($insert);
                //result
                return response()->json(['status' => true, 'id' => $saveData, 'message' => 'Insert data sucessfully']);
            }
        }
    }

    public function update($id, Request $request)
    {
        $validation = ValidationExtension::validationUpdate($request, $id);
        if ($validation) {
            return response()->json($validation, 400);
        } else {

            if ($request->semester == '01') {
                $name = 'Semester 1 Tahun ' . $request->year;
            } else {
                $name = 'Semester 2 Tahun ' . $request->year;
            }

            $update = RequestExtension::fieldsData($request);
            $check = Extension::where(['slug' => $request->year . $request->semester, 'id' => $id])->first();

            if ($check) {
                $UpdateData = Extension::where('id', $id)->update($update);


                $log = array(
                    'category' => 'LOG_DATA_PERIODE_EXTENSION',
                    'group_menu' => 'mengubah_data_periode',
                    'description' => 'Mengubah data Extension <b>' . $name . '</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);
                //Audit Log
            } else {

                $checklain = Extension::where(['slug' => $request->year . $request->semester])->first();
                if ($checklain) {
                    $err['messages']['semester'] = 'Semester dan tahun sudah pernah dibuat.';
                    $err['messages']['year'] = 'Semester dan tahun sudah pernah dibuat.';
                    return response()->json($err, 400);
                } else {



                    $log = array(
                        'category' => 'LOG_DATA_PERIODE_EXTENSION',
                        'group_menu' => 'mengubah_data_periode',
                        'description' => 'Mengubah data Extension <b>' . $name . '</b>',
                    );
                    $datalog = RequestAuditLog::fieldsData($log);
                    //Audit Log

                    $UpdateData = Extension::where('id', $id)->update($update);
                }
            }

            return response()->json(['status' => true, 'id' => $UpdateData, 'message' => 'Update data sucessfully']);
        }
    }

    public function delete($id)
    {
        $messages['messages'] = false;
        $_res = Extension::find($id);
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
            'action' => 'Delete Extension Select',
            'slug' => 'delete-Extension-select',
            'type' => 'post',
            'json_field' => $json,
            'url' => 'api/Extension/selected/'
        );

        RequestAuditLog::fieldsData($log);

        foreach ($request->data as $key) {
            $find = Extension::where('id', $key)->first();
            if ($find->semester == '01') {
                $name = 'Semester 1 Tahun ' . $find->year;
            } else {
                $name = 'Semester 2 Tahun ' . $find->year;
            }

            $log = array(
                'category' => 'LOG_DATA_PERIODE_EXTENSION',
                'group_menu' => 'menghapus_data_periode',
                'description' => '<b>' . $name . '</b> telah dihapus',
            );
            // $datalog = RequestAuditLog::fieldsData($log);
            $results = Extension::where('id', (int)$key)->delete();
        }

        if ($results) {
            $messages['messages'] = true;
        }

        return response()->json($messages);
    }

    
    
}
