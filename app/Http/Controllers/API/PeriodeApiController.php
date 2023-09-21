<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periode;
use App\Http\Request\RequestPeriode;
use App\Http\Request\Validation\ValidationPeriode;
use App\Helpers\GeneralPaginate;
use Auth;
use DB;
use App\Http\Request\RequestAuditLog;
class PeriodeApiController extends Controller
{


    public function __construct()
    {
       
    }

    public function index(Request $request)
    {
        // $_res = array();
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

        $query =  DB::table('periode as a')
            ->select('a.id', 'a.slug', 'a.year', 'c.pagu_apbn', 'c.pagu_promosi', 'c.target_pengawasan', 'c.target_bimbingan_teknis', 'c.target_penyelesaian_permasalahan')
            ->where('a.status', 'Y')
            ->where('c.daerah_id', Auth::User()->daerah_id);
        if ($request->type == 'POST') {
            $query->whereNotIn(
                'slug',
                DB::table('perencanaan')
                    ->select('periode_id')->where('daerah_id', Auth::User()->daerah_id)
            );
        } else {
            $query->whereIn(
                'slug',
                DB::table('perencanaan')
                    ->select('periode_id')->where('daerah_id', Auth::User()->daerah_id)
            );
        }
        $query->join('pagu_target as c', 'a.year', '=', 'c.periode_id')
            ->groupBy('year');



        $data = $query->get();
        if ($data->count() != 0) {
            $selected = false;
        } else {
            $selected = true;
        }
        $periode = RequestPeriode::SelectAll($data, $request->type);
        return response()->json(['selected' => $selected, 'result' => $periode]);
    }





     public function search(Request $request){
        $search = $request->search;
        $_res = array();
        $column_search  = array('name', 'slug','year');

        $i = 0;
        $query  = Periode::orderBy('id','DESC');
        foreach ($column_search as $item)
        {
            if ($search) 
            {                
                if ($i === 0) {   
                   $query->where($item,'LIKE','%'.$search.'%');
                } else {
                   $query->orWhere($item,'LIKE','%'.$search.'%');
                }   
            }
            $i++;
        }
       
        $data = $query->paginate($request->per_page);
        $description = $search;
        $_res = RequestPeriode::GetDataAll($data,$request->per_page,$request,$description);
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

            $check = Periode::where(['slug'=>$request->year.$request->semester])->first();
            if($check)
            { 

               
                $err['messages']['semester'] = 'Semester dan tahun sudah pernah dibuat.';
                $err['messages']['year'] = 'Semester dan tahun sudah pernah dibuat.';
 
               
               return response()->json($err, 400);
            }else{ 
                $insert = RequestPeriode::fieldsData($request);

                $json = json_encode($insert);
                $log = array(             
                'action'=> 'Insert Periode',
                'slug'=>'insert-periode',
                'type'=>'post',
                'json_field'=> $json,
                'url'=>'api/periode'
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

        $validation = ValidationPeriode::validationUpdate($request,$id);
        if ($validation) {
            return response()->json($validation, 400);
        } else {
            
            $update = RequestPeriode::fieldsData($request); 
            $check = Periode::where(['slug'=>$request->year.$request->semester,'id'=>$id])->first();

            if($check)
            {
                $UpdateData = Periode::where('id', $id)->update($update);

            }else{

                $checklain = Periode::where(['slug'=>$request->year.$request->semester])->first();
                if($checklain)
                {
                     $err['messages']['semester'] = 'Semester dan tahun sudah pernah dibuat.';
                     $err['messages']['year'] = 'Semester dan tahun sudah pernah dibuat.';
                     return response()->json($err, 400); 

                }else{

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

         $json = json_encode($_res);
        //Audit Log
        $log = array(             
        'action'=> 'Delete Periode',
        'slug'=>'delete-periode',
        'type'=>'delete',
        'json_field'=> $json,
        'url'=>'api/periode/'.$id
        );

        
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
        RequestAuditLog::fieldsData($log);

        $json = json_encode($request->data);
        //Audit Log
        $log = array(             
        'action'=> 'Delete Periode Select',
        'slug'=>'delete-periode-select',
        'type'=>'post',
        'json_field'=> $json,
        'url'=>'api/periode/selected/'
        );

        RequestAuditLog::fieldsData($log);
        foreach ($request->data as $key) {
            $results = Periode::where('id', (int)$key)->delete();
        }

        if ($results) {
            $messages['messages'] = true;
        }

        return response()->json($messages);
    }

    public function listAll2(Request $request)
    {

        $query =  DB::table('periode as a')
            ->select('a.id', 'a.slug', 'a.year')
            ->where('a.status', 'Y')
            ->groupBy('year');

        $data = $query->get();

        $periode = RequestPeriode::SelectAll2($data);
        return response()->json($periode);
    }
}
