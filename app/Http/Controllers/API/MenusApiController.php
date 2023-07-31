<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\RequestMenus;
use App\Http\Request\Validation\ValidationMenus;
use App\Http\Request\Search\SearchMenus;
use App\Helpers\GeneralPaginate;
use App\Models\Menus;
use App\Models\RoleMenu;
use App\Models\User;
use App\Models\Roles;
use App\Models\MenuPosition;


class MenusApiController extends Controller
{

   
    public function __construct()
    {   
        $this->perPage = GeneralPaginate::limit();
        $this->UploadFolder = GeneralPaginate::uploadPhotoFolder();
    }

    public function index()
    {
        $_res = array();
        $menu = Menus::orderBy('id', 'ASC')->get();
        $role = Roles::where('status','Y')->orderBy('id', 'ASC')->get();
        $description = '';
        $resultMenu = RequestMenus::GetDataAll($menu,$description);
        $resultRole = RequestMenus::RoleMenu($role);

        return response()->json(['menu'=>$resultMenu,'role'=>$resultRole]);

    }

    public function search(Request $request){
        $search = $request->search;
        $_res = array();
        $column_search  = array('name','type','foldername');

        $i = 0;
        $query  = Menus::orderBy('id','DESC');
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
       
        $Data = $query->get();
        $description = $search;
        $_res = RequestMenus::GetDataAll($Data,$description);
               
    
        return response()->json($_res);

    }

    

    



    public function edit($id){
        $Menus = Menus::find($id);
        $type = "edit";
        $_res = RequestMenus::GetDataID($type,$Menus);
        return response()->json($_res);  

    }


       
    public function store(Request $request){
          
     
        $validation = ValidationMenus::validation($request);
        if($validation !=null || $validation !="")
        {
          return response()->json($validation,400);  
        }else{
            
           $fields = RequestMenus::fieldsData($request);  
           $saveAccount = Menus::create($fields);
           return response()->json(['status'=>true,'id'=>$saveAccount,'message'=>'Insert data sucessfully']);    
            
        }    

    }

    public function update($id,Request $request)
    {
        $type = "update";
        $validation = ValidationMenus::validation($request);
        if($validation !=null || $validation !="")
        {
            return response()->json($validation,400);  
        }else{

            $CheckIcon = RequestMenus::CheckIcon($id);//delete file icon
            $update = RequestMenus::fieldsData($request);
            //update account
            $UpdateAccount = Menus::where('id',$id)->update($update);
          
            return response()->json(['status'=>true,'id'=>$UpdateAccount,'message'=>'Update data sucessfully']);
        
          
        } 


    }
    
    public function delete($id){

       $messages['messages'] = false;
        $_res = Menus::find($id);
          
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }

        $CheckIcon = RequestMenus::CheckIcon($id);

        $results = $_res->delete();
        if($results){
            $messages['messages'] = true;
        }
        return response()->json($messages);
    } 
   

    


}    