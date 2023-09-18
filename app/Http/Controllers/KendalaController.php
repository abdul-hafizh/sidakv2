<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;
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
        RequestSystemLog::CreateLog($log);
        $with =  ['title' => $title,'template'=>'template/'.$this->template];
       
        return view('template/' . $this->template . '.kendala.index')->with($with);
       
     
    }

    public function show($topic)
    {
        
        $query = DB::table('kriteria_kendala')->where('slug',$topic)->first(); 
         if($query)
        { 

            $title = 'Kriteria '.$query->category; 
            $log = array(             
                'menu'=>$title,
                'slug'=>'kriteria-topik',
                'url'=>'kriteria/'.$topic.'',
            );
            RequestSystemLog::CreateLog($log);
            $with =  ['title' => $title,'template'=>'template/'.$this->template];
            return view('template/' . $this->template . '.kendala.masalah')->with($with);

                
        }else{
            abort(404);
        }
  

    }



 
   
}
