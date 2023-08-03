<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;

use Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->title = 'Dashboard';
        $this->template = RequestSettingApps::AppsTemplate();
        $this->sidebar = RequestSettingApps::AppsSidebar();
    }

    public function index(Request $request)
    {

      
        return view('template/' . $this->template . '.dashboard.index')
        ->with(
            [
              'title' => $this->title,
              'sidebar' =>$this->sidebar,
              'template'=>'template/'.$this->template
            ]);
    }

    public function store(Request $request)
    {

        
            

         
      
    }


    public function add(Request $request)
    {

        
            

         
      
    }

    public function edit($id,Request $request)
    {

        
            

         
      
    }

     public function show($id,Request $request)
    {

        
            

         
      
    }


     public function update($id,Request $request)
    {

        
            

         
      
    }


     public function delete($id,Request $request)
    {

        
            

         
      
    }



    // public function show(Request $request)
    // {

    //     return view('template/' . $this->template . '.index')->with(['title' => $this->title]);
    // }
}
