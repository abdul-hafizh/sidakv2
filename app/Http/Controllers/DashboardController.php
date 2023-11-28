<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;
use App\Http\Request\RequestAuth;

class DashboardController extends Controller
{

    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
        
    }

    public function index(Request $request)
    {
        $title = 'Dashboard';
        $log = array(             
            'menu'=>$title,
            'slug'=>'dashboard',
            'url'=>'dashboard'
        );
        RequestSystemLog::CreateLog($log);

        $access = RequestAuth::Access();
        if($access =='pusat' || $access =='admin')
        {
             $view = 'template/' . $this->template . '.dashboard.pusat'; 
        }else{
             $view = 'template/' . $this->template . '.dashboard.province';
        }    

        return view($view)
            ->with(
                [
                    'title' =>  $title,
                    'template' => 'template/' . $this->template
                ]
            );
      
        
    }

    
}
