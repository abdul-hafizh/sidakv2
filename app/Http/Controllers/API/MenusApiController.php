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
            
           $insert = RequestMenus::fieldsData($request);  

           if($request->icon)
            {   
                $slug =  Auth::User()->username;
                $source = explode(";base64,", $request->icon);
                $extFile = explode("image/", $source[0]);
                $extentions = $extFile[1];
                $fileDir = '/images/menu/';
                $image = base64_decode($source[1]);
                $filePath = public_path() .$fileDir;
                $photo = time() . '-' . $slug.'.'.$extentions;
                $success = file_put_contents($filePath.$photo, $image);
             
                $user_photo = ["icon"=>$photo];
                $merge = array_merge($insert,$user_photo);
            }else{
                $merge = $insert;
            }


            $log = array(             
            'category'=> 'LOG_DATA_MENU',
            'group_menu'=>'upload_data_menu',
            'description'=>'Menambahkan data menu <b>'.$request->name.'</b>',
            );
            $datalog = RequestAuditLog::fieldsData($log);

           $saveAccount = Menus::create($merge);
           return response()->json(['status'=>true,'id'=>$saveAccount,'message'=>'Insert data sucessfully']);    
            
        }    

    }

    public function update($id,Request $request)
    {
        
        $validation = ValidationMenus::validationUpdate($request,$id);
        if($validation !=null || $validation !="")
        {
            return response()->json($validation,400);  
        }else{

             $update = RequestMenus::fieldsData($request);
             if($request->icon)
             {   
                $slug = Auth::User()->username;
                $source = explode(";base64,", $request->icon);
                $extFile = explode("image/", $source[0]);
                $extentions = $extFile[1];
                $fileDir = '/images/menu/';
                $image = base64_decode($source[1]);
                $filePath = public_path() .$fileDir;
                $photo = time() . '-' . $slug.'.'.$extentions;
                $success = file_put_contents($filePath.$photo, $image);
                
                $check = Menus::find($id);
                if($check)
                { 
                   File::delete(public_path() .$fileDir.$check->icon);
                } 
                $user_photo = ['icon'=> $photo];
                $merge = array_merge($update,$user_photo);
                
            }else{
                $merge = $update;

            }


                $log = array(             
                'category'=> 'LOG_DATA_MENU',
                'group_menu'=>'mengubah_data_menu',
                'description'=>'Mengubah data menu <b>'.$request->name.'</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);
                //Audit Log

            $UpdateAccount = Menus::where('id',$id)->update($merge);
            return response()->json(['status'=>true,'id'=>$UpdateAccount,'message'=>'Update data sucessfully']);
        
          
        } 


    }
    
    public function delete($id){

       $messages['messages'] = false;
        $_res = Menus::find($id);
          
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }else{
             $fileDir = '/images/menu/';
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