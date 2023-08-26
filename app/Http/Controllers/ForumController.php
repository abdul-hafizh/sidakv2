<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;

class ForumController extends Controller
{
   
   
    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
    }

    public function index(Request $request)
    {
        $title = 'Data Forum';
        $log = array(             
            'menu'=>$title,
            'slug'=>'forum',
            'url'=>'forum'
        );
        RequestSystemLog::CreateLog($log);
        $with =  ['title' => $title,'template'=>'template/'.$this->template];
        if($_COOKIE['access'] =="admin")
        {
            return view('template/' . $this->template . '.forum.admin')->with($with);
        }else if($_COOKIE['access'] =="daerah" || $_COOKIE['access'] =="province"){
            return view('template/' . $this->template . '.forum.daerah')->with($with);

        }    

     
    }

 
   
}
