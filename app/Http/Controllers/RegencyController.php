<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;


class RegencyController extends Controller
{

    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
        
    }

    public function index(Request $request)
    {
         $title = 'Data Kabupaten';
         $log = array(             
            'menu'=>$title,
            'slug'=>'kabupaten',
            'url'=>'kabupaten'
        );
        RequestSystemLog::CreateLog($log);
      
        return view('template/' . $this->template . '.regency.index')
        ->with(
            [
              'title' => $title,
              'template'=>'template/'.$this->template
            ]);
    }

    
}
