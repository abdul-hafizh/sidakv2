<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Roles;

use App\Http\Request\RequestMenus;
use App\Http\Request\RequestMenuRoles;
use App\Http\Request\RequestRoles;
use App\Http\Request\Search\SearchRoles;
use App\Http\Request\Validation\ValidationRoles;
use App\Helpers\GeneralPaginate;
use DB;
class RolesApiController extends Controller
{

   
    public function __construct()
    {   
        $this->perPage = GeneralPaginate::limit();
    }

    public function index(Request $request)
    {
        $paginate = GeneralPaginate::limit();
        $Data = Roles::orderBy('id', 'DESC')->paginate($paginate);
        $description = '';
        $_res = RequestRoles::GetDataAll($Data,$this->perPage,$request,$description);
        return response()->json($_res);

    }

    

   

   

    

    public function search(Request $request){
        $search = $request->search;
        $_res = array();
        $column_search  = array('name', 'slug');

        $i = 0;
        $query  = Roles::orderBy('id','DESC');
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
       
        $Data = $query->paginate($this->perPage);
        $description = $search;
        $_res = RequestRoles::GetDataAll($Data,$this->perPage,$request,$description);
               
    
        return response()->json($_res);

    }



       
    public function store(Request $request){

        $validation = ValidationRoles::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{

            
           $insert = RequestRoles::fieldsData($request);  
            //create menu
           $saveData = Roles::create($insert);
            //result
            return response()->json(['status'=>true,'id'=>$saveData,'message'=>'Insert data sucessfully']);    
            
        } 
    }

    public function update($id,Request $request){
     
        $validation = ValidationRoles::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{
            
               $update = RequestRoles::fieldsData($request);
                //update account
               $UpdateData = Roles::where('id',$id)->update($update);
                //result
               return response()->json(['status'=>true,'id'=>$UpdateData,'message'=>'Update data sucessfully']);
            
          
        }   

    }

    public function deleteSelected(Request $request){
        $messages['messages'] = false;
        foreach($request->data as $key)
        {
            $results = Roles::where('id',(int)$key)->delete();
        }

        if($results){
            $messages['messages'] = true;
        }

        return response()->json($messages);
    
    }

    public function delete($id){
        $messages['messages'] = false;
        $_res = Roles::find($id);
          
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }

        $results = $_res->delete();
        if($results){
            $messages['messages'] = true;
        }
        return response()->json($messages);
    
    }


    


    


}    