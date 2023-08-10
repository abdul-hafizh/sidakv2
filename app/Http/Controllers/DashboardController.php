<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;



class DashboardController extends Controller
{

    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
        
    }

    public function index(Request $request)
    {

      
        return view('template/' . $this->template . '.dashboard.index')
        ->with(
            [
              'title' => 'Dashboard',
              'template'=>'template/'.$this->template
            ]);
    }

    
}
