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
            $slug = rand(1000,9999);
            if($request->icon)
            {   
               
                $sourceIcon = explode(";base64,", $request->icon);
                $extFileIcon = explode("image/", $sourceIcon[0]);
                $extentionsIcon = $extFileIcon[1];
                $fileDirIcon = '/images/menu/';
                $imageIcon = base64_decode($sourceIcon[1]);
                $filePathIcon = public_path() .$fileDirIcon;
                $icon = time() . '-' . $slug.'.'.$extentionsIcon;
                $successIcon = file_put_contents($filePathIcon.$icon, $imageIcon);
             
                $menu_icon = ["icon"=>$icon];
                $merge = array_merge($insert,$menu_icon);
            }else{
                $merge = $insert;
            }

            if($request->icon_hover)
            {   
               
                $sourceHover = explode(";base64,", $request->icon_hover);
                $extFileHover = explode("image/", $sourceHover[0]);
                $extentionsHover = $extFileHover[1];
                $fileDirHover = '/images/menu/';
                $imageHover = base64_decode($sourceHover[1]);
                $filePathHover = public_path() .$fileDirHover;
                $hover = time() . '-hover-' . $slug.'.'.$extentionsHover;
                $successHover = file_put_contents($filePathHover.$hover, $imageHover);
             
                $icon_hover = ["icon_hover"=>$hover];
             
                $photo_icon = array_merge($merge,$icon_hover);
            }else{
                $photo_icon = $merge;
            }


            $log = array(             
            'category'=> 'LOG_DATA_MENU',
            'group_menu'=>'upload_data_menu',
            'description'=>'Menambahkan data menu <b>'.$request->name.'</b>',
            );
            $datalog = RequestAuditLog::fieldsData($log);

          $saveAccount = Menus::create($photo_icon);
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
             $slug = rand(1000,9999);
             if($request->icon)
             {   
               
                $sourceIcon = explode(";base64,", $request->icon);
                $extFileIcon = explode("image/", $sourceIcon[0]);
                $extentionsIcon = $extFileIcon[1];
                $fileDirIcon = '/images/menu/';
                $imageIcon = base64_decode($sourceIcon[1]);
                $filePathIcon = public_path() .$fileDirIcon;
                $icon = time() . '-' . $slug.'.'.$extentionsIcon;
                $successIcon = file_put_contents($filePathIcon.$icon, $imageIcon);
                
                $check = Menus::find($id);
                if($check)
                { 
                   File::delete(public_path() .$fileDirIcon.$check->icon);
                } 
                $menu_icon = ["icon"=>$icon];
                $merge = array_merge($update,$menu_icon);
                
            }else{
                $merge = $update;

            }

            if($request->icon_hover)
            {   
               
                $sourceHover = explode(";base64,", $request->icon_hover);
                $extFileHover = explode("image/", $sourceHover[0]);
                $extentionsHover = $extFileHover[1];
                $fileDirHover = '/images/menu/';
                $imageHover = base64_decode($sourceHover[1]);
                $filePathHover = public_path() .$fileDirHover;
                $hover = time() . '-hover-' . $slug.'.'.$extentionsHover;
                $successHover = file_put_contents($filePathHover.$hover, $imageHover);
                $check = Menus::find($id);
                if($check)
                { 
                   File::delete(public_path() .$fileDirHover.$check->icon_hover);
                } 
                $icon_hover = ["icon_hover"=>$hover];
                $photo_icon = array_merge($merge,$icon_hover);
            }else{
                $photo_icon = $merge;
            }




                $log = array(             
                'category'=> 'LOG_DATA_MENU',
                'group_menu'=>'mengubah_data_menu',
                'description'=>'Mengubah data menu <b>'.$request->name.'</b>',
                );
                $datalog = RequestAuditLog::fieldsData($log);
                //Audit Log

            $UpdateAccount = Menus::where('id',$id)->update($photo_icon);
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