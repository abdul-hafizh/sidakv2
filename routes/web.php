<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\SettingWebController; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;

   
    Route::get('/', function () {
        return redirect('login');
    }); 
  
    Route::resource('/login', AuthController::class);      
    if(!empty($_COOKIE['access']))
    {    
            // if (!Auth::check())
            // {
            //         Auth::logout();
            //         unset($_COOKIE['access']); 
            //         setcookie('token', '', -1, '/');
            //         setcookie('access', '', -1, '/'); 
            //         return redirect('login');

            // }
           
             Route::get('/dashboard',  [DashboardController::class, 'index']);      
            Route::middleware(['auth','admin'])->group(function () {

                Route::resource('/user', UserController::class); 
                Route::get('/role', [RoleController::class,'getdata']);     
                // Route::resource('/apps', SettingWebController::class);
              
                Route::get('/user/destroy',  [UserController::class, 'destroy']);               
            });

            

            Route::middleware(['auth','pusat'])->group(function () {
           
                    
            });


            Route::middleware(['auth','province'])->group(function () {

            });

            if(Request::segment(1) =='login')
            {
                Route::get('/login', function () {
                    return redirect('dashboard');
                }); 
                
            }

            Route::get('/logout', function () {
              
                if (isset($_COOKIE['access'])) 
                {
                    Auth::logout();
                    unset($_COOKIE['access']); 
                    setcookie('token', '', -1, '/');
                    setcookie('access', '', -1, '/'); 
                    return redirect('login');  
                }
             
           
           });

                

    }else{

        Route::get('/logout', function () {
              
            if (isset($_COOKIE['access'])) 
            {
                Auth::logout();
                unset($_COOKIE['access']); 
                setcookie('token', '', -1, '/');
                setcookie('access', '', -1, '/'); 
                return redirect('login');
            }
             
           
        });



    }
        
       


        
 
   
    
 
 


