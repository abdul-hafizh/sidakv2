<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Models\SettingApps;
use Auth;

class SettingWebController extends Controller
{

    public function __construct()
    {
        $this->title = 'Apps';
        $this->body = 'skin-default sidebar-mini';
        $this->template = RequestSettingApps::AppsTemplate();
    }

    public function index(Request $request)
    {

       $data = SettingApps::first();
       $result = RequestSettingApps::GetDataApps($data);
     
        return view('template/' . $this->template . '.apps.index')
        ->with(
            [
              'result'=> $result, 
              'title' => $this->title,
              'body' => $this->body,
              'template'=>'template/'.$this->template
            ]);
    }

    public function store(Request $request)
    {

        
            

         
      
    }



    // public function show(Request $request)
    // {

    //     return view('template/' . $this->template . '.index')->with(['title' => $this->title]);
    // }
}
