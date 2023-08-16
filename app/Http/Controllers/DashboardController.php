<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;


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
      
        return view('template/' . $this->template . '.dashboard.index')
        ->with(
            [
              'title' => $title,
              'template'=>'template/'.$this->template
            ]);
    }

    
}
