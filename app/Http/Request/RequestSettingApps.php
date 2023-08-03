<?php

namespace App\Http\Request;
use Auth;
use App\Helpers\GeneralHelpers;
use App\Models\SettingApps;

class RequestSettingApps 
{

   public static function AppsSidebar(){
      $data = SettingApps::first();
      $result = RequestSettingApps::GetDataApps($data);
      return  $result;
   } 
   
   public static function GetDataApps($data)
   {
            $temp = array();
             
            if($data->logo_lg)
            {   
                $logoLg = url(env('URL_FILE', 'images/').$data->logo_lg);
            }else{
                $logoLg = url(env('URL_TEMPLATE').'logo_sidak.png');
            }  

            if($data->logo_sm)
            {   
                $logoSm = url(env('URL_FILE', 'images/').$data->logo_sm);
            }else{
                $logoSm = url(env('URL_TEMPLATE').'logo_icon.png');
            }  
          


            $temp['id'] = $data->id;
            $temp['title'] = $data->title;
            $temp['about'] = $data->about;
            $temp['contact'] = $data->contact;
            $temp['address'] = $data->address;
            $temp['facebook'] = $data->facebook;
            $temp['instagram'] = $data->instagram;
            $temp['twitter'] = $data->twitter;
            $temp['logo_lg'] = $logoLg;
            $temp['logo_sm'] =  $logoSm;
            $results = $temp;

            return json_decode(json_encode($results),FALSE);
   }

  
  


   public static function fieldsData($request)
   {
    

        $data = SettingApps::first();
        $logo_lg =  $data->logo_lg;
        $logo_sm =  $data->logo_sm;
        $fields1 = [  
                'title'  =>  $request->title,
                'about'  =>  $request->about,
                'address'  =>  $request->address,
                'contact'  =>  $request->contact,
                'facebook'  =>  $request->facebook,
                'instagram'  =>  $request->instagram,
                'twitter'  =>  $request->twitter,
                'created_at' => date('Y-m-d H:i:s'),
        ];  
   
       
        $merge = array('account'=>$fields1,'logo_lg'=>$logo_lg,'logo_sm'=>$logo_sm);    
        return $merge;

   }


    public static function AppsWeb(){

        $apps = SettingApps::first();
        if($apps)
        {
            $title = $apps->title; 
        }else{
            $title = env('APP_NAME',true); 
        }  

        return $title;  

   }

   public static function AppsTemplate(){

        $apps = SettingApps::first();
        if($apps)
        {
            $template = $apps->template; 
        }else{
            $template = env('APP_TEMPLATE',true); 
        }  

        return $template;  

   }

   

}