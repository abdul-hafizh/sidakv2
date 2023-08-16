<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestSystemLog;

class RoleController extends Controller
{
   
   
    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
        

    }

    public function index(Request $request)
    {
        $title = 'Data Role';
        $log = array(             
            'menu'=> $title,
            'slug'=>'role',
            'url'=>'role'
        );
        RequestSystemLog::CreateLog($log);
        
        return view('template/' . $this->template . '.role.index')
        ->with(
            [
              'title' => $title,
              'template'=>'template/'.$this->template
            ]);
    }

   
   
}
