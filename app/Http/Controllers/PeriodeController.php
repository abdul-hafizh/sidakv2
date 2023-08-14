<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;

class PeriodeController extends Controller
{
   
   
    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
    }

    public function index(Request $request)
    {
        
        return view('template/' . $this->template . '.periode.index')
        ->with(
            [
              'title' => 'Data Periode',
              'template'=>'template/'.$this->template
            ]);
    }

 
   
}
