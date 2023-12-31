<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;
use App\Http\Request\RequestAuth;
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
        $access = RequestAuth::Access();
        RequestSystemLog::CreateLog($log);
        $with =  ['title' => $title,'access'=>$access,'template'=>'template/'.$this->template];
       
        return view('template/' . $this->template . '.forum.index')->with($with);
     
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
        $access = RequestAuth::Access();
        $with =  ['title' => $title,'template'=>'template/'.$this->template];
        if($access=="admin" ||  $access =="pusat")
        {
            return view('template/' . $this->template . '.forum.topik')->with($with);
        }else if($_COOKIE['access'] =="daerah" || $_COOKIE['access'] =="province"){
            return view('template/' . $this->template . '.forum.topik')->with($with);

        }    

     
    }



 
   
}
