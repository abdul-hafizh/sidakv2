<?php

namespace App\Http\Request;
use Auth;
use App\Helpers\GeneralHelpers;
use App\Models\SettingApps;
use App\Helpers\GeneralPaginate;
class RequestSettingApps 
{
   
   public static function GetDataApps($data)
   {
            $__temp_ = array();
             
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
          


            $__temp_['id'] = $data->id;
            $__temp_['title'] = $data->title;
            $__temp_['about'] = $data->about;
            $__temp_['contact'] = $data->contact;
            $__temp_['address'] = $data->address;
            $__temp_['facebook'] = $data->facebook;
            $__temp_['instagram'] = $data->instagram;
            $__temp_['twitter'] = $data->twitter;
            $__temp_['logo_lg'] = $logoLg;
            $__temp_['logo_sm'] =  $logoSm;
            $results['result'] = $__temp_;
            return $results;
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


   

   

}