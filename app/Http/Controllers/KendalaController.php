<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;
use App\Http\Request\RequestAuth;
use DB;
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
        $access = RequestAuth::Access();
        RequestSystemLog::CreateLog($log);
        $with =  ['title' => $title,'access'=>$access,'template'=>'template/'.$this->template];
       
        return view('template/' . $this->template . '.kendala.index')->with($with);
       
     
    }

    public function show($topic)
    {
        
        $query = DB::table('kriteria_kendala')->where('slug',$topic)->first(); 
         if($query)
        { 

            $title = 'Kendala '.$query->category; 
            $log = array(             
                'menu'=>$title,
                'slug'=>'kendala-topik',
                'url'=>'kendala/'.$topic.'',
            );
            RequestSystemLog::CreateLog($log);
            $with =  ['title' => $title,'template'=>'template/'.$this->template];
            return view('template/' . $this->template . '.kendala.masalah')->with($with);

                
        }else{
            abort(404);
        }
  

    }

     public function detail($topic,$id)
    {
        
        $query = DB::table('kriteria_kendala')->where('slug',$topic)->first(); 
         if($query)
        { 

            $title = 'Kendala '.$query->category; 
            $log = array(             
                'menu'=>$title,
                'slug'=>'kendala-topik',
                'url'=>'kendala/'.$topic.'',
            );
            RequestSystemLog::CreateLog($log);
            $with =  ['title' => $title,'template'=>'template/'.$this->template];
            return view('template/' . $this->template . '.kendala.masalah')->with($with);

                
        }else{
            abort(404);
        }
  

    }



 
   
}
