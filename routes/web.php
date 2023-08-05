<?php

use App\Models\Roles;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingWebController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaguTargetController;
use App\Http\Controllers\PerencanaanController;

Route::get('/', function () {
    return redirect('login');
});

Route::resource('/login', AuthController::class);
Route::resource('/dashboard', DashboardController::class);

if (!empty($_COOKIE['access'])) {

    Route::middleware(['auth', 'admin'])->group(function () {

        Route::resource('/apps', SettingWebController::class);
        Route::resource('/user', UserController::class);
        Route::resource('/pagutarget', PaguTargetController::class);
    });


    Route::middleware(['auth', 'pusat'])->group(function () {
        Route::resource('/perencanaan', PerencanaanController::class);
    });


    Route::middleware(['auth', 'daerah', 'provinsi'])->group(function () {
        
    });


    if (Request::segment(1) == 'login') {
        Route::get('/login', function () {
            return redirect('dashboard');
        });
    }


    Route::get('/logout', function () {

        if (isset($_COOKIE['access'])) {
            Auth::logout();
            unset($_COOKIE['access']);
            setcookie('access', '', -1, '/');
            return redirect('login');
        }
    });
} else {
    if (Request::segment(1) == 'login') {
        return redirect('login');
    }
}
