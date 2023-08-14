<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingWebController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PaguTargetController;
use App\Http\Controllers\PerencanaanController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RegencyController;
   
    Route::get('/', function () {
        return redirect('login');
    }); 
  
    Route::get('/login', [AuthController::class,'index'])->name('login');    
    Route::post('/login', [AuthController::class,'store']);  
 

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [DashboardController::class,'index']);           
    });

    Route::middleware(['auth','admin'])->group(function () {           
        Route::get('/user',  [UserController::class,'index']); 
        Route::get('/role', [RoleController::class,'index']);      
        Route::get('/apps', [SettingWebController::class,'index']);

        Route::get('/province', [ProvinceController::class,'index']); 
        Route::get('/regency', [RegencyController::class,'index']);           
    });

    Route::middleware(['auth','pusat'])->group(function () {
        Route::get('/pagutarget', [PaguTargetController::class,'index']);         
    });

    Route::middleware(['auth','province'])->group(function () {
                         
    });


    Route::middleware(['auth','daerah'])->group(function () {
        Route::get('/perencanaan', [PerencanaanController::class,'index']);
        Route::get('/perencanaan/add', [PerencanaanController::class,'add']);
        Route::get('/perencanaan/edit/{id}', [PerencanaanController::class,'edit']);       
    });

    Route::get('/logout', function () {

        if (isset($_COOKIE['access']))
        {
            Auth::logout();
            setcookie('token', '', -1, '/');
            setcookie('access', '', -1, '/');
            return redirect('login');
        }
    });


  
