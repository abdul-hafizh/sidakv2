<?php

namespace App\Http\Request;

use App\Models\SystemLog;
use Auth;

class RequestSystemLog
{


   
    public function CreateLog($request)
    {
        $username = array('created_by'=> Auth::User()->username);
        $input = array_merge($request,$username);
        $data = SystemLog::create($input);
        return $data;
    }

     

   

   


}