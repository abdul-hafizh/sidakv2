<?php

use App\Models\Roles;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\SettingWebController; 

   
    Route::get('/', function () {
        return redirect('login');
    }); 
                 
    Route::resource('/login', AuthController::class);

    if(!empty($_COOKIE['access']))
    {    
    
        Route::middleware(['auth','admin'])->group(function () {

       
              
              Route::resource('/dashboard', DashboardController::class);
              Route::resource('/apps', SettingWebController::class);


            if(Request::segment(1) =='login')
            {
                Route::get('/login', function () {
                    return redirect('dashboard');
                }); 
            }
                    
        });


        Route::get('/logout', function () {
              
            if (isset($_COOKIE['access'])) 
            {
                Auth::logout();
                unset($_COOKIE['access']); 
                setcookie('access', '', -1, '/'); 
                return redirect('login');
            }

           
        });
 
    }else{
        if(Request::segment(1) =='login')
        {
           return redirect('login'); 
        }
       
    }

    
 
 


