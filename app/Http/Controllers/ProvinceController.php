<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;



class ProvinceController extends Controller
{

    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
        
    }

    public function index(Request $request)
    {

      
        return view('template/' . $this->template . '.province.index')
        ->with(
            [
              'title' => 'Data Provinsi',
              'template'=>'template/'.$this->template
            ]);
    }

    
}
