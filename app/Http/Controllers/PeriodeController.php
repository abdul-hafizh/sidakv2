<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;
use App\Http\Request\RequestPeriode;
use App\Models\Periode;

class PeriodeController extends Controller
{
   
   
    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
    }

    public function index(Request $request)
    {
        $title = 'Data Periode';
        $log = array(             
            'menu'=>$title,
            'slug'=>'periode',
            'url'=>'periode'
        );
        RequestSystemLog::CreateLog($log);

         $query = Periode::select('id','name','slug','semester','year','startdate','enddate','status','created_at')->orderBy('created_at', 'DESC')->get();
        $result = RequestPeriode::GetDataPrint($query);

        return view('template/' . $this->template . '.periode.index')
        ->with(
            [
              'title' => $title,
              'data' => $result,
              'template'=>'template/'.$this->template
            ]);
    }

 
   
}
