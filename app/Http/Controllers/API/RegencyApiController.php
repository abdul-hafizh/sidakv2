<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\RequestRegency;
use App\Http\Request\Validation\ValidationRegency;
use App\Models\Regencies;
use App\Models\Provinces;
use DB;

class RegencyApiController extends Controller
{


    public function __construct()
    {
   
    }

    public function index(Request $request)
    {
        
           
        $query = DB::table('regencies as a')->select('a.id','a.name','b.id as province_id','b.name as province_name','a.created_by','a.created_at')->join('provinces as b','a.province_id','=','b.id')->orderBy('a.created_at', 'DESC');
        if($request->per_page !='all')
        {
           $data = $query->paginate($request->per_page);
        }else{   
           $data = $query->get(); 
        } 

        
        $_res = RequestRegency::GetDataAll($data, $request->per_page, $request);
        return response()->json($_res);
    }


    public function store(Request $request)
    {

        $validation = ValidationRegency::validationInsert($request);
        if ($validation) {
            return response()->json($validation, 400);
        } else {


            $insert = RequestRegency::fieldsData($request);
            //create menu
            $saveData = Regencies::create($insert);
            //result
            return response()->json(['status' => true, 'id' => $saveData, 'message' => 'Insert data sucessfully']);
        }
    }






    public function search(Request $request)
    {
        $search = $request->search;
        $search_daerah = $request->daerah_id;
        $_res = array();
        $column_search  = array('name');

        if($search == '')
        {
             $query  = Regencies::where('province_id',$search_daerah)->orderBy('id','DESC');
        }else{

            $i = 0;
            $query  = Regencies::select('id','name','province_id','created_by','created_at')->orderBy('id','ASC');
            $check = Provinces::where('name','LIKE','%' . $search . '%')->first();
            if($check)
            {
                $query->where('province_id',$check->id);
            }else{

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
            
            }

        }    

       

        if($request->per_page !='all')
        {
           $data = $query->paginate($request->per_page);
        }else{   
           $data = $query->get(); 
        } 
        $description = $search;
        $_res = RequestRegency::GetDataAll($data, $request->per_page, $request, $description);
        return response()->json($_res);
    }






    public function update($id, Request $request)
    {

        $validation = ValidationRegency::validationUpdate($request,$id);
        if ($validation) {
            return response()->json($validation, 400);
        } else {

            $update = RequestRegency::fieldsData($request);
            //update account
            $UpdateData = Regencies::where('id', $id)->update($update);
            //result
            return response()->json(['status' => true, 'id' => $UpdateData, 'message' => 'Update data sucessfully']);
        }
    }

    public function deleteSelected(Request $request)
    {
        $messages['messages'] = false;
        foreach ($request->data as $key) {
            $results = Regencies::where('id', (int)$key)->delete();
        }

        if ($results) {
            $messages['messages'] = true;
        }

        return response()->json($messages);
    }

    public function delete($id)
    {
        $messages['messages'] = false;
        $_res = Regencies::find($id);

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
