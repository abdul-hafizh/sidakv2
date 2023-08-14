<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Request\RequestUser;
use App\Helpers\GeneralPaginate;
use App\Http\Request\Validation\ValidationUser;
use Yajra\DataTables\DataTables;
use File;
use Auth;

class UserApiController extends Controller
{

   
    public function __construct()
    {   
        $this->perPage = GeneralPaginate::limit();
        $this->UploadFolder = GeneralPaginate::uploadPhotoFolder();
       
    }

    public function index(Request $request)
    {
        // $_res = array();
         $data = User::orderBy('created_at', 'DESC')->paginate($this->perPage);
         $description = '';
         $result = RequestUser::GetDataAll($data,$this->perPage,$request);
         return response()->json($result);


        //return Datatables::of($result)->make(true);
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
        $validation = ValidationUser::validationInsert($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{

            
           $insert = RequestUser::fieldsData($request,'insert');  
            //create menu
           $saveData = User::create($insert);
            //result
            return response()->json(['status'=>true,'id'=>$saveData,'message'=>'Insert data sucessfully']);    
            
        } 

    }

     public function update($id,Request $request){
     
        $validation = ValidationUser::validationUpdate($request);
        if($validation !=null || $validation !="")
        {
          return response()->json($validation,400);  
        }else{
            
               $update = RequestUser::fieldsData($request,'update');
                //update account
               $UpdateData = User::where('id',$id)->update($update);
                //result
               return response()->json(['status'=>true,'id'=>$UpdateData,'message'=>'Update data sucessfully']);
            
          
        }   

    }

     public function search(Request $request){
        $search = $request->search;
        $_res = array();
        $column_search  = array('username', 'name','email','phone');

        $i = 0;
        $query  = User::orderBy('id','DESC');
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
       
        $data = $query->paginate($this->perPage);
        $description = $search;
        $result = RequestUser::GetDataAll($data,$this->perPage,$request);
        return response()->json($result);

    }

    public function deleteSelected(Request $request){
        $messages['messages'] = false;
        foreach($request->data as $key)
        {
            $results = User::where('id',(int)$key)->delete();
        }

        if($results){
            $messages['messages'] = true;
        }

        return response()->json($messages);
    
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