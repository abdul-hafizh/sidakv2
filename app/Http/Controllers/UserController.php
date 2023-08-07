<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestUser;
use App\Http\Request\RequestDaerah;
use App\Helpers\GeneralPaginate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
      
        
        $this->title = 'User';
        $this->template = RequestSettingApps::AppsTemplate();
        $this->sidebar = RequestSettingApps::AppsSidebar();

        $this->perPage = GeneralPaginate::limit();
    }

    public function index(Request $request)
    {
        
        $data = User::orderBy('id', 'ASC')->paginate($this->perPage)->onEachSide(0);
        $result = RequestUser::GetDataAll($data,$this->perPage,$request);
        $list_daerah = RequestDaerah::GetDaerahID();
       

        return view('template/' . $this->template . '.user.index')
        ->with(
            [

              'result' => $data,
              'daerah' => $list_daerah,
              'paginate' => $data->links('vendor.pagination.default'),   
              'title' => $this->title,
              'sidebar' =>$this->sidebar,
              'template'=>'template/'.$this->template
            ]);
    }

    public function create(Request $request)
    {

       
       
         
      
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
