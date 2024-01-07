<?php

namespace App\Http\Request;
use Auth;
use App\Helpers\GeneralHelpers;
use Illuminate\Support\Str;
use App\Http\Request\RequestAuth;
use App\Models\User;
use App\Models\Notification;


class RequestNotification 
{

    public static function GetDataAll($data, $perPage, $request)
  {
    $temp = array();
    $getRequest = $request->all();
    $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
    if($perPage !='all')
    {
         $numberNext = (($page * $perPage) - ($perPage - 1));
    }else{
         $numberNext = (($page * $data->count()) - ($data->count() - 1));
    }  
    foreach ($data as $key => $val) {

          $temp[$key]['number'] = $numberNext++;
          $temp[$key]['id'] = $val->id;
          $messages =  $val->messages;
          if (strlen($messages) > 50) {
            $messages = substr($messages, 0, 50) . "...";
          } 

          if($_COOKIE['access'] !='admin' && $_COOKIE['access'] !='pusat')
          { 

            $temp[$key]['photo'] = RequestAuth::photoUser($val->from);
           
          }else{
             $temp[$key]['photo'] = RequestAuth::photoUser($val->sender);
           
          }   
         $temp[$key]['name'] = ucwords(strtolower($val->type));
         $temp[$key]['url'] = $val->url; 
         $temp[$key]['messages'] = $messages;
         $temp[$key]['created_at'] = GeneralHelpers::timeAgo($val['created_at']);
    }

       $result['data'] = $temp;
       if($perPage !='all')
       {
           $result['current_page'] = $data->currentPage();
           $result['last_page'] = $data->lastPage();
           $result['total'] = $data->total(); 
       }else{
           $result['current_page'] = 1;
           $result['last_page'] = 1;
           $result['total'] = $data->count(); 
       } 
   
    return $result;
  }
   
   public static function GetDataLimit($data)
   {
          $temp = array();
          $access = RequestAuth::Access();
          foreach($data as $key => $val)
          {
             $messages =  $val->messages;
             if (strlen($messages) > 25) {
                $messages = substr($messages, 0, 25) . "...";
             } 

            if($access !='admin' && $access !='pusat')
            { 

                $temp[$key]['photo'] = RequestAuth::photoUser($val->from);
               
             }else{
                 $temp[$key]['photo'] = RequestAuth::photoUser($val->sender);
               
             } 
                $temp[$key]['id'] = $val->id;   
             $temp[$key]['name'] = ucwords(strtolower($val->type)); 
               $temp[$key]['url'] = $val->url; 
            $temp[$key]['messages'] = $messages;
            $temp[$key]['created_at'] = GeneralHelpers::timeAgo($val['created_at']);
          } 

        if($access =='admin' && $access =='pusat')
        {
          $total = Notification::where(['view_from'=>'false','sender'=>Auth::User()->username])->count();
          $total_all = Notification::where('sender',Auth::User()->username)->count();  
        }else{
          $total = Notification::where('from','!=',Auth::User()->username)->where(['view_sender'=>'false'])->count();
          $total_all = Notification::where('from','!=',Auth::User()->username)->where(['view_sender'=>'false'])->count();   
        }  
           
          if($total>0)
          {
            $total_not_show = $total;
          }else{
            $total_not_show = 0;
          } 
          $result['data'] = $temp;
          $result['total_not_show'] =  $total_not_show;
          $result['total_all'] = $total_all;
          return $result;  

   }


   public static function check($id){

      $check = Notification::where(['id'=>$id,'view_from'=>'true'])->first();
      if($check)
      {
        $result = true;
      }else{
         $result = false;
      }
      return $result;  
   }

  
 

   public static function fieldsData($type,$messages,$url,$sender)
   {
        $uuid = Str::uuid()->toString();
        //$pusat = User::where(['username'=>'pusat'])->first();
      

        // if(Auth::User()->username == $pusat->username)
        // {
        //     $sender = $pusat->username;
        // }  

        $fields = [ 
                'id'=> $uuid,
                'type'  =>  $type,
                'messages'  => $messages ,
                'from'  =>  Auth::User()->username,
                'sender'  =>  $sender,
                'url' => $url,
                'view_from'  =>  'false',
                'view_sender'  =>  'false',
                'created_by' => Auth::User()->username,
                'updated_by' => '',
                'created_at' => date('Y-m-d H:i:s'),
        ];
        return $fields;
   }

   

  

   

}