<?php

use App\Models\Roles;
use Illuminate\Support\Facades\Route;
use App\Http\Request\RequestMenuRoles;
use App\Http\Controllers\LayoutController;
 

   
    Route::get('/', function () {
        return redirect('login');
    }); 
       
    
    Route::resource('/login', LayoutController::class);
    Route::resource('/register', LayoutController::class);
    if(!empty($_COOKIE['access']))
    {    
    
    Route::middleware(['authRole'])->group(function () {

       if($_COOKIE['access'])
       { 
             $access = Roles::where('slug',$_COOKIE['access'])->first();
             $menu = RequestMenuRoles::Roles($access->id);
           
              
             if($menu)
             {
                $data = json_decode($menu);
                $result = RequestMenuRoles::RoleTasks($data);
                //dd($result);
                $check = RequestMenuRoles::CheckMenuRole($result);
                if($check)
                {

                   foreach($result as $kuy =>$val)
                   {
                     Route::get($val->path_web,  'App\Http\Controllers\LayoutController@index');                   
                   }   
                }    
                
                Route::get('/menu', 'App\Http\Controllers\LayoutController@index');
               // Route::resource('/user/edit/{id}', LayoutController::class);

                if(Request::segment(1) =='login')
                {
                    Route::get('/login', function () {
                        return redirect('dashboard');
                    }); 
                    
                }
                

             }else{
                
                if (isset($_COOKIE['access'])) {
                    unset($_COOKIE['access']); 
                    setcookie('access', '', -1, '/'); 
                    setcookie('token', '', -1, '/');
                    return true;
                } else {
                    return false;
                }


             }   
             
       }    
                
    });
 
    }else{
        if(Request::segment(1) =='login')
        {
           return redirect('login'); 
        }
       
    }

    
 
 






