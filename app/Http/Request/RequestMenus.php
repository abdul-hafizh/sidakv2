<?php

namespace App\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Helpers\GeneralHelpers;
use App\Models\User;
use App\Helpers\GeneralPaginate;
use App\Models\Menus;
use App\Models\RoleMenu;
use App\Http\Request\RequestMenuRoles;
class RequestMenus
{

  
   
   public static function GetDataAll($data,$description)
   {

        $temp = array();
        
   	    foreach ($data as $key => $val)
        {
            if($val->icon =="")
            {
                $icon = url('/template/'.$template.'/img/user.png');
            }else{
                $icon = url('/images/menu/'.$val->icon);
            }  

            if($val->status =="Y") { $status = "Aktif";  }else{ $status = "Non Aktif"; }
          
            $temp[$key]['id'] = $val->id;
            $temp[$key]['name'] = $val->name;
            $temp[$key]['slug'] = $val->slug;
            $temp[$key]['path_web'] = $val->path_web;
            // $__temp_[$key]['path_vue'] = $val->path_vue;
            // $__temp_[$key]['path_api'] = $val->path_api;
            // $__temp_[$key]['foldername'] = $val->foldername;
            // $__temp_[$key]['filename'] = $val->filename;
            // $__temp_[$key]['type'] = $val->type;
            // $__temp_[$key]['type_icon'] = $val->type_icon;
            $temp[$key]['icon'] = $icon;
            $temp[$key]['edit'] = false;
            $temp[$key]['tasks'] = [];
            $temp[$key]['status'] = $status;
            $temp[$key]['status_ori'] = $val->status;
           // $__temp_[$key]['created_at'] = GeneralHelpers::tanggal_indo($val['created_at']);
        }

        $results['result'] = $temp;
        $results['total'] = count($data);
        return $results;

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
      
            
                $source = explode(";base64,", $request->icon);
                $extFile = explode("image/", $source[0]);
                $extentions = $extFile[1];
                $fileDir = '/images/menu/';
                $image = base64_decode($source[1]);
                $filePath = public_path() .$fileDir;
                $fileIcon = time() . '-' . $slug.'.'.$extentions;
                $success = file_put_contents($filePath.$fileIcon, $image);
                

                
    
        
        $fields = [  
                'name'  =>  $request->name,
                'slug' =>  $slug,
                // 'path_vue'  =>  $path_vue,
                'path_web'  =>  $path_web,
                // 'path_api'  =>  $path_api,
                // 'type'  => $request->type,
                // 'type_icon'  => $request->type_icon,
                // 'foldername'  =>$foldername,
                // 'filename'  => $filename,
                'icon'  => $fileIcon,
                'status'  => 'unlock',
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
        ];
        return $fields;

   }

  


}