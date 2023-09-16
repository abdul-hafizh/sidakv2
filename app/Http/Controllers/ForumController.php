<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;
use DB;
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

    public function show($topic)
    {
        
        $query = DB::table('forum')->where('slug',$topic)->first()->category; 
        $title = 'Forum '.$query; 
        $log = array(             
            'menu'=>$title,
            'slug'=>'forum-topik',
            'url'=>'forum/'.$topic.''
        );
        RequestSystemLog::CreateLog($log);
        $with =  ['title' => $title,'template'=>'template/'.$this->template];
        if($_COOKIE['access'] =="admin")
        {
            return view('template/' . $this->template . '.forum.topik')->with($with);
        }else if($_COOKIE['access'] =="daerah" || $_COOKIE['access'] =="province"){
            return view('template/' . $this->template . '.forum.topik')->with($with);

        }    

     
    }



 
   
}
