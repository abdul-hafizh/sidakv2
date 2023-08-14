<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;


class RoleController extends Controller
{
   
   
    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
        

    }

    public function index(Request $request)
    {
        
        return view('template/' . $this->template . '.role.index')
        ->with(
            [
              'title' => 'Data Role',
              'template'=>'template/'.$this->template
            ]);
    }

   
   
}
