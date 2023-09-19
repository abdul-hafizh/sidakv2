<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Action;
use App\Http\Request\RequestAction;
use App\Http\Request\Validation\ValidationAction;
use DB;
use App\Http\Request\RequestAuditLog;

class ActionApiController extends Controller
{

   
    public function __construct()
    {   
        
    }

    public function index(Request $request)
    {
       

        // $_res = array();
         $query = Action::orderBy('created_at', 'DESC');
         if($request->per_page !='all')
         {
           $data = $query->paginate($request->per_page);
         }else{   
           $data = $query->get(); 
         }   
        
         $result = RequestAction::GetDataAll($data,$request->per_page,$request);
         return response()->json($result);


    }

   

    
      public function listAll(Request $request)
    {
        $query = Action::select('id','slug as value','name as text','status')->orderBy('created_at', 'DESC')->get();
        $data = RequestAction::GetAction($query);
        return response()->json($data);

    }
   

   

    

    public function search(Request $request){
        $search = $request->search;
        $_res = array();
        $column_search  = array('name', 'slug');

        $i = 0;
        $query  = Action::orderBy('id','DESC');
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
       
        $Data = $query->paginate($request->per_page);
        $description = $search;
        $_res = RequestAction::GetDataAll($Data,$request->per_page,$request,$description);
               
    
        return response()->json($_res);

    }



       
    public function store(Request $request){

        $validation = ValidationAction::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{

            
            $insert = RequestAction::fieldsData($request);  

            $json = json_encode($insert);
            $log = array(             
            'action'=> 'Insert Aksi',
            'slug'=>'insert-aksi',
            'type'=>'post',
            'json_field'=> $json,
            'url'=>'api/action'
            );

            $datalog = RequestAuditLog::fieldsData($log);

            //create menu
           $saveData = Action::create($insert);
            //result
            return response()->json(['status'=>true,'id'=>$saveData,'message'=>'Insert data sucessfully']);    
            
        } 
    }

    public function update($id,Request $request){
     
        $validation = ValidationAction::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{
            
               $update = RequestAction::fieldsData($request);

               //Audit Log
                $json = json_encode($update);
                
                $log = array(             
                'action'=> 'Update Aksi',
                'slug'=>'update-aksi',
                'type'=>'put',
                'json_field'=> $json,
                'url'=>'api/action/'.$id
                );

                $datalog =  RequestAuditLog::fieldsData($log);

                //update account
               $UpdateData = Action::where('id',$id)->update($update);
                //result
               return response()->json(['status'=>true,'id'=>$UpdateData,'message'=>'Update data sucessfully']);
            
          
        }   

    }

    public function deleteSelected(Request $request){
        $messages['messages'] = false;
        foreach($request->data as $key)
        {
            $results = Action::where('id',(int)$key)->delete();
        }

        if($results){
            $messages['messages'] = true;
        }

        return response()->json($messages);
    
    }

    public function delete($id){
        $messages['messages'] = false;
        $_res = Action::find($id);

        $json = json_encode($_res);
        //Audit Log
        $log = array(             
        'action'=> 'Delete Aksi',
        'slug'=>'delete-aksi',
        'type'=>'delete',
        'json_field'=> $json,
        'url'=>'api/action/'.$id
        );

        RequestAuditLog::fieldsData($log);
          
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