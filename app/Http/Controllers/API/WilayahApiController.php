<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wilayah;
use App\Http\Request\RequestWilayah;
use App\Http\Request\Validation\ValidationWilayah;
use App\Http\Request\RequestAuditLog;
use DB;

class WilayahApiController extends Controller
{

   
    public function __construct()
    {   
        
    }

    public function index(Request $request)
    {
       

        // $_res = array();
         $query = Wilayah::orderBy('created_at', 'DESC');
         if($request->per_page !='all')
         {
           $data = $query->paginate($request->per_page);
         }else{   
           $data = $query->get(); 
         }   
        
         $result = RequestWilayah::GetDataAll($data,$request->per_page,$request);
         return response()->json($result);


    }

    
      public function listAll(Request $request)
    {
        $query = Roles::select('id','slug as value','name as text','status')->orderBy('created_at', 'DESC')->get();
        $data = RequestRoles::GetRoles($query);
        return response()->json($data);

    }
   

   

    

    public function search(Request $request){
        $search = $request->search;
        $_res = array();
        $column_search  = array('name', 'slug');

        $i = 0;
        $query  = Wilayah::orderBy('id','DESC');
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
        $_res = RequestWilayah::GetDataAll($Data,$this->perPage,$request,$description);
               
    
        return response()->json($_res);

    }



       
    public function store(Request $request){

        $validation = ValidationWilayah::validationInsert($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{

            
           $insert = RequestWilayah::fieldsData($request);  

            $log = array(             
            'category'=> 'LOG_DATA_USER_WILAYAH',
            'group_menu'=>'upload_data_user_wilayah',
            'description'=>'Menambahkan data user wilayah <b>'.$request->name.'</b>',
            );
            $datalog = RequestAuditLog::fieldsData($log);

            //create menu
           $saveData = Wilayah::create($insert);
            //result
            return response()->json(['status'=>true,'id'=>$saveData,'message'=>'Insert data sucessfully']);    
            
        } 
    }

    public function update($id,Request $request){
     
        $validation = ValidationWilayah::validationUpdate($request,$id);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{
            
               $update = RequestWilayah::fieldsData($request);
                //update account

                $log = array(             
                'category'=> 'LOG_DATA_USER_WILAYAH',
                'group_menu'=>'mengubah_data_user_wilayah',
                'description'=>'Mengubah data user wilayah <b>'.$request->name.'</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);
                //Audit Log

               $UpdateData = Wilayah::where('id',$id)->update($update);
                //result
               return response()->json(['status'=>true,'id'=>$UpdateData,'message'=>'Update data sucessfully']);
            
          
        }   

    }

    public function deleteSelected(Request $request){
        $messages['messages'] = false;
        foreach($request->data as $key)
        {
            $find = Wilayah::where('id',$key)->first();
            $log = array(             
                'category'=> 'LOG_DATA_USER_WILAYAH',
                'group_menu'=>'menghapus_data_user_wilayah',
                'description'=> '<b>'.$find->name.'</b> telah dihapus',
                );
            $datalog = RequestAuditLog::fieldsData($log);

            $results = Wilayah::where('id',(int)$key)->delete();
        }

        if($results){
            $messages['messages'] = true;
        }

        return response()->json($messages);
    
    }

    public function delete($id){
        $messages['messages'] = false;
        $_res = Wilayah::find($id);
          
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }

        $log = array(             
            'category'=> 'LOG_DATA_USER_WILAYAH',
            'group_menu'=>'menghapus_data_user_wilayah',
            'description'=> '<b>'.$_res->name.'</b> telah dihapus',
            );
        $datalog = RequestAuditLog::fieldsData($log);

        $results = $_res->delete();
        if($results){
            $messages['messages'] = true;
        }
        return response()->json($messages);
    
    }


    


    


}    