<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\ConfigHeader;
use App\Helpers\GeneralPaginate;

class LayoutController extends Controller
{
   
    public function __construct()
    {
        $this->title = ConfigHeader::index();
        $this->template = GeneralPaginate::template();
    }
    
    public function index(Request $request)
    {
        return view('template/'.$this->template.'.index')->with(['title'=>$this->title]); 
    }

    public function show(Request $request){

        return view('template/'.$this->template.'.index')->with(['title'=>$this->title]); 
    }

     

    
    
}
