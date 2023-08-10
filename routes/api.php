<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\API\AuthApiController;
use App\Http\Controllers\API\PeriodeApiController;
use App\Http\Controllers\API\MenusApiController;
use App\Http\Controllers\API\MenusRoleApiController;
use App\Http\Controllers\API\RolesApiController;
use App\Http\Controllers\API\PaguTargetApiController;
use App\Http\Controllers\API\SettingWebApiController;
use App\Http\Controllers\API\PerencanaanApiController;
use App\Http\Controllers\API\PengawasanApiController;
use App\Http\Controllers\API\UserApiController;

use App\Http\Controllers\API\MobilApiController;
use App\Http\Controllers\API\DaerahApiController;

Route::middleware(['jwt.auth','admin'])->group(function () {

     Route::get('select-daerah', [DaerahApiController::class, 'listAll']);

     Route::get('profile', [AuthApiController::class, 'getAuthUser']);
     Route::get('user/menu', [AuthApiController::class, 'sidebar']);

     Route::get('user', [UserApiController::class, 'index']);
     Route::post('user', [UserApiController::class, 'store']);
     Route::put('user/{id}', [UserApiController::class, 'update']);
     Route::post('user/search', [UserApiController::class, 'search']);
     Route::post('user/selected', [UserApiController::class, 'deleteSelected']);
     Route::delete('user/{id}', [UserApiController::class, 'delete']);

     Route::get('pagutarget/datalist', [PaguTargetApiController::class, 'jsonData']);
     Route::get('pengawasan/datalist', [PengawasanApiController::class, 'jsonData']);

     Route::get('mobil', [MobilApiController::class, 'index']);
     Route::post('mobil', [MobilApiController::class, 'store']);

     Route::get('dashboard', [DashboardApiController::class, 'index']);
     Route::get('menu', [MenusApiController::class, 'index']);
     Route::post('menu', [MenusApiController::class, 'store']);
     Route::post('menu/search', [MenusApiController::class, 'search']);
     Route::put('menu/{id}', [MenusApiController::class, 'update']);
     Route::delete('menu/{id}', [MenusApiController::class, 'delete']);
     Route::post('menu/table', [MenusApiController::class, 'table']);

     Route::post('menu/role/keys', [MenusRoleApiController::class, 'keys']);
     Route::post('menu/role/save', [MenusRoleApiController::class, 'store']);
     Route::post('menu/pages/save', [MenusRoleApiController::class, 'pages']);
     Route::delete('menu/role/{id}', [MenusRoleApiController::class, 'delete']);

     Route::get('role', [RolesApiController::class, 'index']);

     Route::get('role/edit/{id}', [RolesApiController::class, 'edit']);
     Route::post('role', [RolesApiController::class, 'store']);
     Route::post('role/search', [RolesApiController::class, 'search']);
     Route::put('role/{id}', [RolesApiController::class, 'update']);
     Route::delete('role/{id}', [RolesApiController::class, 'delete']);
     Route::post('role/selected', [RolesApiController::class, 'deleteSelected']);

     Route::get('perencanaan', [PerencanaanApiController::class, 'index']);

     Route::get('periode', [PeriodeApiController::class, 'index']);
     Route::get('periode/create', [PeriodeApiController::class, 'create']);
     Route::get('periode/edit/{id}', [PeriodeApiController::class, 'edit']);
     Route::post('periode', [PeriodeApiController::class, 'store']);
     Route::post('periode/search', [PeriodeApiController::class, 'search']);
     Route::put('periode/{id}', [PeriodeApiController::class, 'update']);
     Route::delete('periode/{id}', [PeriodeApiController::class, 'delete']);

     Route::get('setting-apps', [SettingWebApiController::class, 'index']);
     Route::put('setting-apps/{id}', [SettingWebApiController::class, 'update']);
});

Route::group(['middleware' => 'jwt.auth','daerah','provinsi'], function () {

     Route::get('profile', [AuthApiController::class, 'getAuthUser']);
     Route::get('user/menu', [AuthApiController::class, 'sidebar']);
    
     Route::get('daerah', [AuthApiController::class, 'GetDaerahID']);
     Route::get('periode/check', [PeriodeApiController::class, 'check']);
     Route::get('perencanaan/periode', [PeriodeApiController::class, 'periode']);
     Route::get('perencanaan', [PerencanaanApiController::class, 'index']);
     Route::post('perencanaan', [PerencanaanApiController::class, 'store']);
     Route::get('perencanaan/edit/{id}', [PerencanaanApiController::class, 'edit']);
     Route::post('perencanaan/search', [PerencanaanApiController::class, 'search']); 
     Route::post('perencanaan/selected', [PerencanaanApiController::class, 'deleteSelected']);
     Route::delete('perencanaan/{id}', [PerencanaanApiController::class, 'delete']);
     Route::post('pagu/check', [PaguTargetApiController::class, 'check']); 

});