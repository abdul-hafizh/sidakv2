<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Perencanaan;
use App\Http\Request\RequestPerencanaan;
use App\Helpers\GeneralPaginate;
use App\Models\RoleUser;
use Auth;

class PerencanaanApiController extends Controller
{

   
    public function __construct()
    {   
        $this->perPage = GeneralPaginate::limit();
    }

    public function index(Request $request)
    {
        $paginate = GeneralPaginate::limit();
        $Data = Perencanaan::orderBy('id', 'DESC')->paginate($paginate);
        $description = '';
        $_res = RequestPerencanaan::GetDataAll($Data,$this->perPage,$request,$description);
        return response()->json($_res);

    }

    

    

    public function search(Request $request){
        $search = $request->search;
        $_res = array();
        $AccountValidate = SearchAcademic::Search($search);
        if(count($AccountValidate) >0)
        {
             $label = $AccountValidate['label'];
             $value = $AccountValidate['value'];
             $Data = Academic::where($label,'LIKE','%'.$value.'%')->orderBy('id', 'DESC')->paginate($this->perPage);
             $description = $search;
             $_res = RequestAcademic::GetDataAll($Data,$this->perPage,$request,$description);
               
        }
        return response()->json($_res);

    }


    public function edit($id){
        $Data = Academic::find($id);
        $_res = RequestAcademic::GetDataID($Data);
        return response()->json($_res);  

    }

       
    public function store(Request $request){

       $validation = ValidationAcademic::validation($request);
        if($validation !=null || $validation !="")
        {
          return response()->json($validation,400);  
        }else{
            
           $insert = RequestAcademic::fieldsData($request);  
            //create menu
           $saveData = Academic::create($insert);
            //result
            return response()->json(['status'=>true,'id'=>$saveData,'message'=>'Insert data sucessfully']);    
            
        } 
    }

    public function update($id,Request $request){
     
        $validation = ValidationAcademic::validation($request);
        if($validation !=null || $validation !="")
        {
          return response()->json($validation,400);  
        }else{
            
               $update = RequestAcademic::fieldsData($request);
                //update account
               $UpdateData = Academic::where('id',$id)->update($update);
                //result
               return response()->json(['status'=>true,'id'=>$UpdateData,'message'=>'Update data sucessfully']);
            
          
        }   

    }

    public function delete($id){
        $messages['messages'] = false;
        $_res = Academic::find($id);
          
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