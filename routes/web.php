<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingWebController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PaguTargetController;
use App\Http\Controllers\PerencanaanController;
use App\Http\Controllers\PengawasanController;
use Illuminate\Support\Facades\Auth;
   
    Route::get('/', function () {
        return redirect('login');
    }); 
  
   Route::get('/login', [AuthController::class,'index']);    
   Route::post('/login', [AuthController::class,'store']);   

       
 
        if (Auth::guest()) {
            // User is authenticated
            if(!empty($_COOKIE['access']))
            {
                

                Route::get('/dashboard', [DashboardController::class,'index']);
                Route::middleware(['auth','admin'])->group(function () {
                   
                    Route::get('/user',  [UserController::class,'index']); 
                    Route::get('/role', [RoleController::class,'index']);      
                    Route::get('/apps', [SettingWebController::class,'index']);
                    
                });
                
                Route::middleware(['auth','pusat'])->group(function () {
                    Route::get('/pagutarget', [PaguTargetController::class,'dt_index']);                              
                });

                // Route::middleware(['auth','province'])->group(function () {
                         
                // });

                Route::middleware(['auth','daerah', 'province'])->group(function () {
                    Route::get('/perencanaan', [PerencanaanController::class,'index']);
                    Route::get('/perencanaan/add', [PerencanaanController::class,'add']);
                    Route::get('/perencanaan/edit/{id}', [PerencanaanController::class,'edit']);     
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
                        setcookie('token', '', -1, '/');
                        setcookie('access', '', -1, '/');
                        return redirect('login');
                    }
                });

            }else{
                // User is not authenticated
                Auth::logout();
                setcookie('token', '', -1, '/');
                setcookie('access', '', -1, '/');
                return redirect('login');
            }
        
    } else {
        // User is not authenticated
        Auth::logout();
        setcookie('token', '', -1, '/');
        setcookie('access', '', -1, '/');
        return redirect('login');
    }
