<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Notification;
use App\Helpers\GeneralPaginate;
use App\Http\Request\RequestForum;
use App\Http\Request\RequestNotification;
use App\Http\Request\Validation\ValidationForum;
use DB;
use Auth;

class ForumApiController extends Controller
{

   
    public function __construct()
    {   
         $this->perPage = GeneralPaginate::limit();
    }

    public function index(Request $request)
    {
       

        $query = Forum::orderBy('created_at', 'DESC');
        if($_COOKIE['access'] !="admin")
        {
            $query->where(['status'=>'Y']);
        }  

        if($request->per_page !='all')
        {
            $data = $query->paginate($request->per_page);
        }else{   
            $data = $query->get(); 
        }   
        
        $result = RequestForum::GetDataAll($data,$request->per_page,$request);
        return response()->json($result);


    }

    


   

    

    public function search(Request $request){
        $search = $request->search;
        $_res = array();
        $column_search  = array('category');

        $i = 0;
        $query  = Forum::orderBy('id','DESC');
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
        // $description = $search;
        $_res = RequestForum::GetDataAll($Data,$this->perPage,$request);
               
    
        return response()->json($_res);

    }


   


       
    public function store(Request $request){

        $validation = ValidationForum::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{

            
           $insert = RequestForum::fieldsData($request);  
            //create menu
           $saveData = Forum::create($insert);
            //result
            return response()->json(['status'=>true,'id'=>$saveData,'message'=>'Insert data sucessfully']);    
            
        } 
    }

    
    public function update($id,Request $request){
     
        $validation = ValidationForum::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{
            
               $update = RequestForum::fieldsData($request);
                //update account
               $UpdateData = Forum::where('id',$id)->update($update);
                //result
               return response()->json(['status'=>true,'id'=>$UpdateData,'message'=>'Update data sucessfully']);
            
          
        }   

    }

    public function deleteSelected(Request $request){
        $messages['messages'] = false;
        foreach($request->data as $key)
        {
            $results = Forum::where('id',(int)$key)->delete();
        }

        if($results){
            $messages['messages'] = true;
        }

        return response()->json($messages);
    
    }

    

    public function delete($id){
        $messages['messages'] = false;
        $_res = Forum::find($id);
          
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