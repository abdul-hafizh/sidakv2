<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Http\Request\RequestKriteria;
use App\Http\Request\Validation\ValidationKriteria;
use DB;

class KriteriaApiController extends Controller
{

   
    public function __construct()
    {   
        
    }

    public function index(Request $request)
    {
       

        // $_res = array();
         $query = Kriteria::orderBy('created_at', 'DESC');
         if($request->per_page !='all')
         {
           $data = $query->paginate($request->per_page);
         }else{   
           $data = $query->get(); 
         }   
        
         $result = RequestKriteria::GetDataAll($data,$request->per_page,$request);
         return response()->json($result);


    }

    
      public function listAll(Request $request)
    {
        $query = Kriteria::select('id','slug as value','name as text','status')->orderBy('created_at', 'DESC')->get();
        $data = RequestKriteria::GetKriteria($query);
        return response()->json($data);

    }
   

   

    

    public function search(Request $request){
        $search = $request->search;
        $_res = array();
        $column_search  = array('name', 'slug');

        $i = 0;
        $query  = Kriteria::orderBy('id','DESC');
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
        $_res = RequestKriteria::GetDataAll($Data,$this->perPage,$request,$description);
               
    
        return response()->json($_res);

    }



       
    public function store(Request $request){

        $validation = ValidationKriteria::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{

            
           $insert = RequestKriteria::fieldsData($request);  
            //create menu
           $saveData = Kriteria::create($insert);
            //result
            return response()->json(['status'=>true,'id'=>$saveData,'message'=>'Insert data sucessfully']);    
            
        } 
    }

    public function update($id,Request $request){
     
        $validation = ValidationKriteria::validation($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{
            
               $update = RequestKriteria::fieldsData($request);
                //update account
               $UpdateData = Kriteria::where('id',$id)->update($update);
                //result
               return response()->json(['status'=>true,'id'=>$UpdateData,'message'=>'Update data sucessfully']);
            
          
        }   

    }

    public function deleteSelected(Request $request){
        $messages['messages'] = false;
        foreach($request->data as $key)
        {
            $results = Kriteria::where('id',(int)$key)->delete();
        }

        if($results){
            $messages['messages'] = true;
        }

        return response()->json($messages);
    
    }

    public function delete($id){
        $messages['messages'] = false;
        $_res = Kriteria::find($id);
          
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