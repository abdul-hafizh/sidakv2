<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;



class RegencyController extends Controller
{

    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
        
    }

    public function index(Request $request)
    {

      
        return view('template/' . $this->template . '.regency.index')
        ->with(
            [
              'title' => 'Data Kabupaten',
              'template'=>'template/'.$this->template
            ]);
    }

    
}
