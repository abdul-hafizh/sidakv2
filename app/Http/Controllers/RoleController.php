<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;

use App\Http\Request\RequestAuth;
use App\Models\RoleUser;
use App\Models\User;



class RoleController extends Controller
{
   
   
    public function __construct()
    {
       
        $this->template = RequestSettingApps::AppsTemplate();
         $this->sidebar = RequestSettingApps::AppsSidebar();

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

   
    public function getdata(Request $request)
    {
        
        return view('template/' . $this->template . '.role.index')
        ->with(
            [
              'title' => 'Data Role',
              'sidebar' =>$this->sidebar,
              'template'=>'template/'.$this->template
            ]);
    }
   
}
