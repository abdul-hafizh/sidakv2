<?php

namespace App\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Helpers\GeneralHelpers;
use App\Models\User;
use App\Helpers\GeneralPaginate;
use App\Models\Menus;
use App\Models\RoleMenu;
use App\Models\Action;
use App\Http\Request\RequestMenuRoles;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestAuditLog;
use File;
class RequestMenus
{

  
   
   public static function GetDataAll($data,$role_id)
   {

        $temp = array();
        $template = RequestSettingApps::AppsTemplate();
   	    foreach ($data as $key => $val)
        {
            if($val->icon =="")
            {
                $icon = url('/template/'.$template.'/img/user.png');
            }else{
                $icon = url('/file/menu/'.$val->icon);
            }  

            if($val->icon_hover =="")
            {
                $icon_hover = url('/template/'.$template.'/img/user.png');
            }else{
                $icon_hover = url('/file/menu/'.$val->icon_hover);
            }  

            $temp[$key]['id'] = $val->id;
            $temp[$key]['name'] = $val->name;
            $temp[$key]['parent'] = $val->parent;
            $temp[$key]['slug'] = $val->slug;
            $temp[$key]['path_web'] = $val->path_web;
            $temp[$key]['option'] = RequestMenus::ActionList();
            $temp[$key]['icon'] = $val->icon;
            $temp[$key]['icon_hover'] =$val->icon_hover;
            $temp[$key]['edit'] = false;
            $temp[$key]['tasks'] = [];
          //  $temp[$key]['move'] = RequestMenus::MoveCheck($role_id,$val->slug);
            $temp[$key]['move'] = true;
            $temp[$key]['status'] = $val->status;

           
        }

        $results['result'] = $temp;
        $results['total'] = count($data);
        return $results;

   }

   public static function CreateMenu($request)
   {

            $insert = RequestMenus::fieldsData($request);  
            $slug = rand(1000,9999);
            if($request->icon)
            {   
               
                $sourceIcon = explode(";base64,", $request->icon);
                $extFileIcon = explode("image/", $sourceIcon[0]);
                $extentionsIcon = $extFileIcon[1];
                $fileDirIcon = '/file/menu/';
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
                $fileDirHover = '/file/menu/';
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

      return $photo_icon;      


   }

   public static function UpdateMenu($request,$id){


             $update = RequestMenus::fieldsData($request);
             $slug = rand(1000,9999);
             if($request->icon)
             {   
               
                $sourceIcon = explode(";base64,", $request->icon);
                $extFileIcon = explode("image/", $sourceIcon[0]);
                $extentionsIcon = $extFileIcon[1];
                $fileDirIcon = '/file/menu/';
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
                $fileDirHover = '/file/menu/';
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

            return $photo_icon;

   }

   public static function RoleMenu($role){
        $rolr = array();
        foreach ($role as $key => $val)
        {
            if($key == 0)
            {
               $active  = 'active'; 
            }else{
               $active  = ''; 
            }

            $rolr[$key]['id'] = $val->id;
            $rolr[$key]['name'] = $val->role->slug;
            $rolr[$key]['show'] = $active;
            $rolr[$key]['tasks'] = json_decode(json_encode($val->menu_json), FALSE);
            
        }

          return  $rolr;  


   }

   public static function MoveCheck($role_id,$slug){
      $temp = array();
      $result = true;
      $query = RoleMenu::where('role_id',$role_id)->first();
      if($query)
      {
          $data = json_decode($query->menu_json);
          foreach($data as $key =>$val)
          {
             if($val->tasks)
             {

                foreach($val->tasks as $keys =>$vals)
                {
                  if($slug == $vals->slug)
                  {
                     $temp[$keys] = $vals->slug;
                 }  

                }    

             }else{
                if($slug == $val->slug)
                {
                   $temp[$key] = $val->slug;
                }   
             }   
               
          }

          if (in_array($slug, $temp)) {
            $result = false;
          } else {
            $result = true;
          } 

      }  


      return $result;
   }

   public static function ActionList(){
      $temp = array();
      $query = Action::Select('id','name','slug')->orderBy('created_at', 'ASC')->get();
      foreach($query as $key =>$val)
      {
         $temp[$key]['action'] = $val->slug;
         $temp[$key]['name'] = $val->name; 
         $temp[$key]['checked'] = false; 
      }

      return $temp;

   }

   


   public static function CheckIcon($id){

        $menu = Menus::find($id); 
        if($menu->type_icon =='file')
        {
            if($menu->icon)
            {   
                unlink(public_path().'/images/menu/'.$menu->icon);
            }  
        }    
        
        return true;

   }

   
   

   public static function fieldsData($request)
   {
        
        // if($request->path_vue =="" || $request->path_vue =="/"){ $path_vue =''; }else{ $path_vue = $request->path_vue; }
        if($request->path_web =="" || $request->path_web =="/"){ $path_web =''; }else{ $path_web = $request->path_web; }
        // if($request->path_api ==""){ $path_api =''; }else{ $path_api = $request->path_api; }
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        // $filename = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '', $request->filename)));
        // $foldername = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '', $request->foldername)));
      
          
                
    
        
        $fields = [  
                'name'  =>  ucfirst($request->name),
                'slug' =>   strtolower(trim($request->slug)),
                'parent'  => $request->parent,
                'path_web'  =>  $path_web,
                // 'path_api'  =>  $path_api,
                // 'type'  => $request->type,
                // 'type_icon'  => $request->type_icon,
                // 'foldername'  =>$foldername,
                // 'filename'  => $filename,
                
                'status'  => 'unlock',
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
        ];
        return $fields;

   }

  


}