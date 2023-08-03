<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Request\RequestUser;
use App\Helpers\GeneralPaginate;
use App\Http\Request\Validation\ValidationUser;
use File;
use Auth;

class UserApiController extends Controller
{

   
    public function __construct()
    {   
        $this->perPage = GeneralPaginate::limit();
       
    }

    public function index(Request $request)
    {
        $_res = array();
        $data = User::orderBy('id', 'DESC')->paginate($this->perPage);
        $description = '';
        $_res = RequestUser::GetDataAll($data,$this->perPage,$request,$description);
        return response()->json($_res);

    }


     public function register(Request $request)
    {
        $validation = ValidationUser::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{

            

           $insert = RequestUser::fieldsData($request);  
            //create menu
           $saveData = User::create($insert);
            //result
            return response()->json(['status'=>true,'id'=>$saveData,'message'=>'Insert data sucessfully']);  
             

            
             
            
        } 

    }

    
    public function store(Request $request)
    {
        $validation = ValidationUser::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{

            
           $insert = RequestUser::fieldsData($request);  
            //create menu
           $saveData = User::create($insert);
            //result
            return response()->json(['status'=>true,'id'=>$saveData,'message'=>'Insert data sucessfully']);    
            
        } 

    }
    

     public function delete($id){

       $messages['messages'] = false;
        $_res = User::find($id);
          
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }else{
            if(file_exists($this->UploadFolder.$_res['photo'])) {
                File::delete($this->UploadFolder.$_res['photo']);
            } 
        }
        $results = $_res->delete();
        if($results){
            $messages['messages'] = true;
        }
        return response()->json($messages);
    }

    


    


}    