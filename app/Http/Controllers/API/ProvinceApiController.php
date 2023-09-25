<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\RequestProvinces;
use App\Http\Request\Validation\ValidationProvinces;
use App\Models\Provinces;
use App\Helpers\GeneralPaginate;
use DB;
use App\Http\Request\RequestAuditLog;
class ProvinceApiController extends Controller
{


    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
         $query = Provinces::orderBy('created_at', 'DESC');
         if($request->per_page !='all')
         {
           $data = $query->paginate($request->per_page);
         }else{   
           $data = $query->get(); 
         }   
        
         $result = RequestProvinces::GetDataAll($data,$request->per_page,$request);
         return response()->json($result);
    }


    public function store(Request $request)
    {

        $validation = ValidationProvinces::validationInsert($request);
        if ($validation) {
            return response()->json($validation, 400);
        } else {


            $insert = RequestProvinces::fieldsData($request);

             $log = array(             
            'category'=> 'LOG_DATA_PROVINSI',
            'group_menu'=>'upload_data_provinsi',
            'description'=>'Menambahkan data provinsi <b>'.$request->name.'</b>',
            );
            $datalog = RequestAuditLog::fieldsData($log);

            //create menu
            $saveData = Provinces::create($insert);
            //result
            return response()->json(['status' => true, 'id' => $saveData, 'message' => 'Insert data sucessfully']);
        }
    }






    public function search(Request $request)
    {
        $search = $request->search;
        $_res = array();
        $column_search  = array('name', 'created_by');

        $i = 0;
        $query  = Provinces::orderBy('id', 'DESC');
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

        if($request->per_page !='all')
        {
           $data = $query->paginate($request->per_page);
        }else{   
           $data = $query->get(); 
        } 
        $description = $search;
        $_res = RequestProvinces::GetDataAll($data, $request->per_page, $request);


        return response()->json($_res);
    }


   




    public function update($id, Request $request)
    {

        $validation = ValidationProvinces::validationUpdate($request,$id);
        if ($validation) {
            return response()->json($validation, 400);
        } else {

            $update = RequestProvinces::fieldsData($request);

                $log = array(             
                'category'=> 'LOG_DATA_PROVINSI',
                'group_menu'=>'mengubah_data_provinsi',
                'description'=>'Mengubah data provinsi <b>'.$request->name.'</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);
                //Audit Log

            //update account
            $UpdateData = Provinces::where('id', $id)->update($update);
            //result
            return response()->json(['status' => true, 'id' => $UpdateData, 'message' => 'Update data sucessfully']);
        }
    }

    public function deleteSelected(Request $request)
    {
        $messages['messages'] = false;

        

        foreach ($request->data as $key) {
            $find = Provinces::where('id',$key)->first();
            $log = array(             
                'category'=> 'LOG_DATA_PROVINSI',
                'group_menu'=>'menghapus_data_provinsi',
                'description'=> '<b>'.$find->name.'</b> telah dihapus',
                );
            $datalog = RequestAuditLog::fieldsData($log);

            $results = Provinces::where('id', (int)$key)->delete();
        }

        if ($results) {
            $messages['messages'] = true;
        }

        return response()->json($messages);
    }

    public function delete($id)
    {
        $messages['messages'] = false;
        $_res = Provinces::find($id);

         $log = array(             
            'category'=> 'LOG_DATA_PROVINSI',
            'group_menu'=>'menghapus_data_provinsi',
            'description'=> '<b>'.$_res->name.'</b> telah dihapus',
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
}
