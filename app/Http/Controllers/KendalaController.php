<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;

class KendalaController extends Controller
{
   
   
    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
    }

    public function index(Request $request)
    {
        $title = 'Data Kendala';
        $log = array(             
            'menu'=>$title,
            'slug'=>'kendala',
            'url'=>'kendala'
        );
        RequestSystemLog::CreateLog($log);
        $with =  ['title' => $title,'template'=>'template/'.$this->template];
        if($_COOKIE['access'] =="admin")
        {
            return view('template/' . $this->template . '.kendala.admin')->with($with);
        }else if($_COOKIE['access'] =="daerah" || $_COOKIE['access'] =="province"){
            return view('template/' . $this->template . '.kendala.daerah')->with($with);

        }    

     
    }

    public function show($topic)
    {
        $title = 'Kendala '.$topic;
        $log = array(             
            'menu'=>$title,
            'slug'=>'kendala-category',
            'url'=>'kendala/'.$topic.''
        );
        RequestSystemLog::CreateLog($log);
        $with =  ['title' => $title,'template'=>'template/'.$this->template];
        if($_COOKIE['access'] =="admin")
        {
            return view('template/' . $this->template . '.kendala.admin')->with($with);
        }else if($_COOKIE['access'] =="daerah" || $_COOKIE['access'] =="province"){
            return view('template/' . $this->template . '.kendala.masalah')->with($with);

        }    

     
    }

 
   
}
