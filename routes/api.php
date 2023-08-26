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

use App\Http\Controllers\API\ProvinceApiController;
use App\Http\Controllers\API\RegencyApiController;
use App\Http\Controllers\API\DaerahApiController;
use App\Http\Controllers\API\AuditLogApiController;
use App\Http\Controllers\API\KendalaApiController;
use App\Http\Controllers\API\ForumApiController;




Route::middleware(['jwt.auth'])->group(function () {

    Route::get('select-province', [DaerahApiController::class, 'listProvince']);
    Route::get('select-daerah', [DaerahApiController::class, 'listAll']);
    Route::get('select-periode', [PeriodeApiController::class, 'listAll']);
    Route::get('profile', [AuthApiController::class, 'getAuthUser']);
    Route::get('user/menu', [AuthApiController::class, 'sidebar']);
    Route::get('profile', [AuthApiController::class, 'getAuthUser']);
    Route::get('user/menu', [AuthApiController::class, 'sidebar']);


   
    Route::get('periode/check', [PeriodeApiController::class, 'check']);
    Route::get('perencanaan/periode', [PeriodeApiController::class, 'periode']);
    Route::get('perencanaan', [PerencanaanApiController::class, 'index']);
    Route::post('perencanaan', [PerencanaanApiController::class, 'store']);
    Route::put('perencanaan/approve/{id}', [PerencanaanApiController::class, 'approve']);
    Route::get('perencanaan/edit/{id}', [PerencanaanApiController::class, 'edit']);
    Route::post('perencanaan/search', [PerencanaanApiController::class, 'search']);
    Route::post('perencanaan/selected', [PerencanaanApiController::class, 'deleteSelected']);
    Route::delete('perencanaan/{id}', [PerencanaanApiController::class, 'delete']);
    Route::post('pagu/check', [PaguTargetApiController::class, 'check']);

    Route::get('user', [UserApiController::class, 'index']);
    Route::post('user', [UserApiController::class, 'store']);
    Route::put('user/{id}', [UserApiController::class, 'update']);
    Route::post('user/search', [UserApiController::class, 'search']);
    Route::post('user/selected', [UserApiController::class, 'deleteSelected']);
    Route::delete('user/{id}', [UserApiController::class, 'delete']);

    Route::get('pagutarget/datalist', [PaguTargetApiController::class, 'jsonData']);
    Route::get('pengawasan/datalist', [PengawasanApiController::class, 'jsonData']);

    Route::get('province', [ProvinceApiController::class, 'index']);
    Route::post('province', [ProvinceApiController::class, 'store']);
    Route::put('province/{id}', [ProvinceApiController::class, 'update']);
    Route::post('province/search', [ProvinceApiController::class, 'search']);
    Route::post('province/selected', [ProvinceApiController::class, 'deleteSelected']);
    Route::delete('province/{id}', [ProvinceApiController::class, 'delete']);

    Route::get('regency', [RegencyApiController::class, 'index']);
    Route::post('regency', [RegencyApiController::class, 'store']);
    Route::put('regency/{id}', [RegencyApiController::class, 'update']);
    Route::post('regency/search', [RegencyApiController::class, 'search']);
    Route::post('regency/selected', [RegencyApiController::class, 'deleteSelected']);
    Route::delete('regency/{id}', [RegencyApiController::class, 'delete']);
    Route::get('dashboard', [DashboardApiController::class, 'index']);


    Route::get('select-role', [RolesApiController::class, 'listAll']);
 
    Route::get('role', [RolesApiController::class, 'index']);
    Route::get('role/edit/{id}', [RolesApiController::class, 'edit']);
    Route::post('role', [RolesApiController::class, 'store']);
    Route::post('role/search', [RolesApiController::class, 'search']);
    Route::put('role/{id}', [RolesApiController::class, 'update']);
    Route::delete('role/{id}', [RolesApiController::class, 'delete']);
    Route::post('role/selected', [RolesApiController::class, 'deleteSelected']);

    Route::get('periode', [PeriodeApiController::class, 'index']);
    Route::post('periode', [PeriodeApiController::class, 'store']);
    Route::post('periode/search', [PeriodeApiController::class, 'search']);
    Route::put('periode/{id}', [PeriodeApiController::class, 'update']);
    Route::delete('periode/{id}', [PeriodeApiController::class, 'delete']);

    Route::get('auditlog', [AuditLogApiController::class, 'index']);
    Route::post('auditlog/search', [AuditLogApiController::class, 'search']);

    Route::get('kendala', [KendalaApiController::class, 'index']);
    Route::post('kendala', [KendalaApiController::class, 'store']);
    Route::post('kendala/replay', [KendalaApiController::class, 'replay']);
    Route::get('kendala/list-replay/{id}', [KendalaApiController::class, 'listreplay']);
    Route::delete('kendala/delete-replay/{id}', [KendalaApiController::class, 'deletereplay']);
    Route::post('kendala/search', [KendalaApiController::class, 'search']);
    Route::put('kendala/{id}', [KendalaApiController::class, 'update']);
    Route::post('kendala/selected', [KendalaApiController::class, 'deleteSelected']);
    Route::delete('kendala/{id}', [KendalaApiController::class, 'delete']);


    Route::get('forum', [ForumApiController::class, 'index']);
    Route::post('forum', [ForumApiController::class, 'store']);
    Route::post('forum/search', [ForumApiController::class, 'search']);
    Route::put('forum/{id}', [ForumApiController::class, 'update']);
    Route::post('forum/selected', [ForumApiController::class, 'deleteSelected']);
    Route::delete('forum/{id}', [ForumApiController::class, 'delete']);

    

    Route::get('setting-apps', [SettingWebApiController::class, 'index']);
    Route::put('setting-apps/{id}', [SettingWebApiController::class, 'update']);
});
