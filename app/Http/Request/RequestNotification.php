<?php

namespace App\Http\Request;
use Auth;
use App\Helpers\GeneralHelpers;
use Illuminate\Support\Str;
use App\Models\User;

class RequestNotification 
{
   
   

  
 

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
                'view'  =>  'false',
                'created_by' => Auth::User()->username,
                'created_at' => date('Y-m-d H:i:s'),
        ];
        return $fields;
   }

   

  

   

}