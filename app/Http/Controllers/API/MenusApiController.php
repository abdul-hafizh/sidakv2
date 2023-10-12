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
use DB;
use File;
use Auth;
use App\Http\Request\RequestAuditLog;

class MenusApiController extends Controller
{

   
    public function __construct()
    {   
        $this->perPage = GeneralPaginate::limit();
        $this->UploadFolder = GeneralPaginate::uploadPhotoFolder();
    }

    public function index(Request $request)
    {
        $_res = array();
        $menu = Menus::orderBy('id', 'ASC')->get();
        $resultMenu = RequestMenus::GetDataAll($menu,$request->role);
        return response()->json($resultMenu );

    }

    public function menuRole()
    {
        $_res = array();
        $role = RoleMenu::orderBy('id', 'ASC')->get();
        $resultRole = RequestMenus::RoleMenu($role);

        return response()->json($resultRole );

    }

    public function search(Request $request){
        $search = $request->search;
        $_res = array();
        $column_search  = array('name','slug');

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
       
        $data = $query->get();
        $description = $search;
        $_res = RequestMenus::GetDataAll($data,$description);
               
    
        return response()->json($_res);

    }

    

    
    public function table(Request $request)
    {
      $table = $request->table;   
      $data =  DB::table($table)->get();
      return response()->json($data); 
    }


    public function edit($id){
        $Menus = Menus::find($id);
        $type = "edit";
        $_res = RequestMenus::GetDataID($type,$Menus);
        return response()->json($_res);  

    }


       
    public function store(Request $request){
          
     
        $validation = ValidationMenus::validationInsert($request);
        if($validation)
        {
          return response()->json($validation,400);  
        }else{

            if($request->path_web =="#")
            {    
            
                  $data = RequestMenus::CreateMenu($request);   
                  $saveAccount = Menus::create($data);
                   return response()->json(['status'=>true,'id'=>$saveAccount,'message'=>'Insert data sucessfully']);    
            }else{

                $check = Menus::where('path_web',$request->path_web)->count();
                if($check > 0)
                {
                    $err['messages']['path_web'] = 'URL Sudah Pernah dibuat';
                    return response()->json($err,400);  
                }else{
                    $data = RequestMenus::CreateMenu($request);   
                    $saveAccount = Menus::create($data);
                    return response()->json(['status'=>true,'id'=>$saveAccount,'message'=>'Insert data sucessfully']);    
                }    
            }
        }    

    }

    public function update($id,Request $request)
    {
        
        $validation = ValidationMenus::validationUpdate($request,$id);
        if($validation !=null || $validation !="")
        {
            return response()->json($validation,400);  
        }else{

            if($request->path_web =="#")
            {
                  $data = RequestMenus::UpdateMenu($request,$id);
                  $UpdateAccount = Menus::where('id',$id)->update($data);
                  return response()->json(['status'=>true,'id'=>$UpdateAccount,'message'=>'Update data sucessfully']);
             
            }else{

                $check = Menus::where(['path_web'=>$request->path_web])->first();
                if($check)
                {
                   if($check->name == $request->name)
                   {  
                      if($check->created_by == Auth::User()->username)
                      {
                            $data = RequestMenus::UpdateMenu($request,$id);
                            $UpdateAccount = Menus::where('id',$id)->update($data);
                            return response()->json(['status'=>true,'id'=>$UpdateAccount,'message'=>'Update data sucessfully']);

                      }  
                   
                   }else{
                      $err['messages']['path_web'] = 'URL Sudah Pernah dibuat';
                      return response()->json($err,400);
                   } 
                }else{

                 

                    $data = RequestMenus::UpdateMenu($request,$id);
                    $UpdateAccount = Menus::where('id',$id)->update($data);
                    return response()->json(['status'=>true,'id'=>$UpdateAccount,'message'=>'Update data sucessfully']);
                
                }    

            }     

           
        
          
        } 


    }
    
    public function delete($id){

       $messages['messages'] = false;
        $_res = Menus::find($id);
          
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }else{
             $fileDir = '/file/menu/';
            if(file_exists(public_path() .$fileDir.$_res->icon)) {
               File::delete(public_path() .$fileDir.$_res->icon);
            } 
        }

        $log = array(             
            'category'=> 'LOG_DATA_MENU',
            'group_menu'=>'menghapus_data_menu',
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