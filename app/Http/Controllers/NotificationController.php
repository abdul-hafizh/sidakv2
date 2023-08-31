<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;


class NotificationController extends Controller
{

    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
        
    }

    public function index(Request $request)
    {
        $title = 'Notification';
        $log = array(             
            'menu'=> $title,
            'slug'=>'notification',
            'url'=>'notification'
        );
        RequestSystemLog::CreateLog($log);
      
        return view('template/' . $this->template . '.notification.index')
        ->with(
            [
              'title' =>  $title,
              'template'=>'template/'.$this->template
            ]);
    }

    
}
