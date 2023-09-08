<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;

class ActionController extends Controller
{
   
   
    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
        

    }

    public function index(Request $request)
    {
        $title = 'Data Aksi';
        $log = array(             
            'menu'=> $title,
            'slug'=>'aksi',
            'url'=>'aksi'
        );
        RequestSystemLog::CreateLog($log);
        
        return view('template/' . $this->template . '.action.index')
        ->with(
            [
              'title' => $title,
              'template'=>'template/'.$this->template
            ]);
    }

   
   
}
