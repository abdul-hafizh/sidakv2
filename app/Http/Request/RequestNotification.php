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
          $tmp = array();
          foreach($data as $key => $val)
          {
             $messages =  $val->messages;
             if (strlen($messages) > 25) {
                $messages = substr($messages, 0, 25) . "...";
             } 

            if($_COOKIE['access'] !='admin' && $_COOKIE['access'] !='pusat')
            { 

                $temp[$key]['photo'] = RequestAuth::photoUser($val->from);
               
             }else{
                 $temp[$key]['photo'] = RequestAuth::photoUser($val->sender);
               
             }   
             $temp[$key]['name'] = ucwords(strtolower($val->type)); 
            $temp[$key]['messages'] = $messages;
            $temp[$key]['created_at'] = GeneralHelpers::timeAgo($val['created_at']);
          } 

        if($_COOKIE['access'] !='admin' && $_COOKIE['access'] !='pusat')
        {
          $total = Notification::where(['view_from'=>'false','sender'=>Auth::User()->username])->count();
          $total_all = Notification::where('sender',Auth::User()->username)->count();  
        }else{
          $total = Notification::where(['view_sender'=>'false'])->count();
          $total_all = Notification::where(['view_sender'=>'false'])->count();   
        }  
           
          if($total>0)
          {
            $total_not_show = $total;
          }else{
            $total_not_show = '';
          } 
          $result['data'] = $temp;
          $result['total_not_show'] =  $total_not_show;
          $result['total_all'] = $total_all;
          return $result;  

   }


   public static function check(){

      $check = Notification::where(['updated_by'=>Auth::User()->username])->first();
      if($check)
      {
        $result = true;
      }else{
         $result = false;
      }
      return $result;  
   }

  
 

   public static function fieldsData($type,$messages)
   {
        $uuid = Str::uuid()->toString();
        $pusat = User::where(['username'=>'pusat'])->first();
        if($pusat)
        {
            $sender = $pusat->username;
        }else{
            $sender = 'null';
        }

        $fields = [ 
                'id'=> $uuid,
                'type'  =>  $type,
                'messages'  => $messages ,
                'from'  =>  Auth::User()->username,
                'sender'  =>  $sender,
                'view_from'  =>  'false',
                'view_sender'  =>  'false',
                'created_by' => Auth::User()->username,
                'updated_by' => '',
                'created_at' => date('Y-m-d H:i:s'),
        ];
        return $fields;
   }

   

  

   

}