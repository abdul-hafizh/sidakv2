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
use App\Http\Controllers\API\DashboardApiController;
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
use App\Http\Controllers\API\NotificationApiController;
use App\Http\Controllers\API\ActionApiController;
use App\Http\Controllers\API\KriteriaApiController;
use App\Http\Controllers\API\BimsosApiController;
use App\Http\Controllers\API\PenyelesaianApiController;
use App\Http\Controllers\API\ExtensionApiController;
use App\Http\Controllers\API\PromosiApiController;
use App\Http\Controllers\API\PemetaanApiController;
use App\Http\Controllers\API\WilayahApiController;
use App\Http\Controllers\API\RekapitulasiApiController;

Route::middleware(['jwt.auth'])->group(function () {

    Route::get('select-role', [RolesApiController::class, 'listAll']);
    Route::get('select-daerah', [DaerahApiController::class, 'listAllDaerah']);
    Route::get('select-kabupaten', [DaerahApiController::class, 'listAllKabupaten']);
    Route::get('select-province', [DaerahApiController::class, 'listAllProvince']);
    Route::get('select-periode', [PeriodeApiController::class, 'listAll']);
    Route::get('select-year', [PeriodeApiController::class, 'listYear']);
    Route::get('select-periode-semester', [PeriodeApiController::class, 'listAllSemester']);
    Route::get('select-anggaran/{id}', [PeriodeApiController::class, 'listAnggaran']);
    Route::get('profile', [AuthApiController::class, 'getAuthUser']);
    Route::get('user/menu', [AuthApiController::class, 'sidebar']);
    Route::post('user/photo', [AuthApiController::class, 'updatePhoto']);
    Route::get('periode/check', [PeriodeApiController::class, 'check']);

    Route::get('sidebar-active', [AuthApiController::class, 'menuSlug']);

    Route::get('perencanaan', [PerencanaanApiController::class, 'index']);
    Route::get('perencanaan/export', [PerencanaanApiController::class, 'export']);
    Route::post('perencanaan', [PerencanaanApiController::class, 'store']);
    Route::put('perencanaan/{id}', [PerencanaanApiController::class, 'update']);
    Route::put('perencanaan/request_doc/{id}', [PerencanaanApiController::class, 'request_doc']);
    Route::put('perencanaan/approve/{id}', [PerencanaanApiController::class, 'approve']);
    Route::put('perencanaan/approve_edit/{id}', [PerencanaanApiController::class, 'approve_edit']);
    Route::put('perencanaan/unapprove/{id}', [PerencanaanApiController::class, 'unapprove']);
    Route::put('perencanaan/unapprove_doc/{id}', [PerencanaanApiController::class, 'unapprove_doc']);
    Route::put('perencanaan/reqedit/{id}', [PerencanaanApiController::class, 'reqedit']);
    Route::put('perencanaan/reqrevisi/{id}', [PerencanaanApiController::class, 'reqrevisi']);
    Route::get('perencanaan/edit/{id}', [PerencanaanApiController::class, 'edit']);
    Route::post('perencanaan/search', [PerencanaanApiController::class, 'search']);
    Route::post('perencanaan/selected', [PerencanaanApiController::class, 'deleteSelected']);
    Route::post('perencanaan/approve_selected', [PerencanaanApiController::class, 'approveSelected']);
    Route::put('perencanaan/upload_laporan/{id}', [PerencanaanApiController::class, 'upload_laporan']);
    Route::get('perencanaan/log/{id}', [PerencanaanApiController::class, 'log']);
    Route::delete('perencanaan/{id}', [PerencanaanApiController::class, 'delete']);

    Route::get('user', [UserApiController::class, 'index']);
    Route::post('user', [UserApiController::class, 'store']);
    Route::put('user/{id}', [UserApiController::class, 'update']);
    Route::post('user/search', [UserApiController::class, 'search']);
    Route::post('user/selected', [UserApiController::class, 'deleteSelected']);
    Route::delete('user/{id}', [UserApiController::class, 'delete']);
    Route::get('user/profile', [UserApiController::class, 'GetUserID']);
    Route::post('user/update', [UserApiController::class, 'updateProfile']);
    Route::post('user/status', [UserApiController::class, 'StatusConfirm']);
    Route::post('user/sendmail', [UserApiController::class, 'sendMail']);

    Route::post('pagu/check', [PaguTargetApiController::class, 'check']);
    Route::get('pagutarget/datalist', [PaguTargetApiController::class, 'jsonData']);
    Route::post('pagutarget/total_pagu', [PaguTargetApiController::class, 'total_pagu']);

    Route::post('pagutarget', [PaguTargetApiController::class, 'store']);
    Route::post('pagutarget/import_excel', [PaguTargetApiController::class, 'import_excel']);
    // Route::get('pagutarget/download_file', [PaguTargetApiController::class, 'download_excel']);
    Route::get('pagutarget/edit/{id}', [PaguTargetApiController::class, 'edit']);
    // Route::get('pagutarget/download_daerah', [PaguTargetApiController::class, 'download_daerah']);
    Route::put('pagutarget/{id}', [PaguTargetApiController::class, 'update']);
    Route::delete('pagutarget/{id}', [PaguTargetApiController::class, 'delete']);
    Route::post('pagutarget/selected', [PaguTargetApiController::class, 'deleteSelected']);

    Route::get('pengawasan/datalist', [PengawasanApiController::class, 'jsonData']);
    Route::post('pengawasan', [PengawasanApiController::class, 'store']);
    Route::get('pengawasan/edit/{id}', [PengawasanApiController::class, 'edit']);
    Route::post('pengawasan/update/{id}', [PengawasanApiController::class, 'update']);
    Route::post('pengawasan/kirim/{id}', [PengawasanApiController::class, 'update']);
    Route::delete('pengawasan/{id}', [PengawasanApiController::class, 'delete']);
    Route::post('pengawasan/selected', [PengawasanApiController::class, 'deleteSelected']);
    Route::put('pengawasan/request_edit/{id}', [PengawasanApiController::class, 'request_edit']);
    Route::put('pengawasan/request_revisi/{id}', [PengawasanApiController::class, 'request_revisi']);
    Route::put('pengawasan/approve_edit/{id}', [PengawasanApiController::class, 'approve_edit']);
    Route::post('pengawasan/header', [PengawasanApiController::class, 'header']);


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
    Route::post('periode/selected', [PeriodeApiController::class, 'deleteSelected']);

    Route::get('extension', [ExtensionApiController::class, 'index']);
    Route::post('extension', [ExtensionApiController::class, 'store']);
    Route::post('extension/search', [ExtensionApiController::class, 'search']);
    Route::put('extension/{type}/{id}', [ExtensionApiController::class, 'approved']);
    Route::put('extension/{id}', [ExtensionApiController::class, 'update']);
    Route::delete('extension/{id}', [ExtensionApiController::class, 'delete']);
    Route::post('extension/selected', [ExtensionApiController::class, 'deleteSelected']);

    Route::get('auditlog', [AuditLogApiController::class, 'index']);
    Route::post('auditlog/search', [AuditLogApiController::class, 'search']);
    Route::delete('auditlog/{id}', [AuditLogApiController::class, 'delete']);
    Route::post('auditlog/selected', [AuditLogApiController::class, 'deleteSelected']);

    Route::get('kendala', [KendalaApiController::class, 'index']);
    Route::post('kendala', [KendalaApiController::class, 'store']);
    Route::post('kendala/search', [KendalaApiController::class, 'searchKendala']);
    Route::put('kendala/{id}', [KendalaApiController::class, 'update']);
    Route::post('kendala/selected', [KendalaApiController::class, 'deleteKendala']);
    Route::delete('kendala/{id}', [KendalaApiController::class, 'delete']);

    Route::get('kendala/{id}', [KendalaApiController::class, 'show']);
    Route::get('masalah/comment/{id}', [KendalaApiController::class, 'commentDetail']);
    Route::post('kendala/{id}/search', [KendalaApiController::class, 'searchKriteria']);
    Route::post('masalah', [KendalaApiController::class, 'saveKendala']);
    Route::get('masalah/list-replay/{id}', [KendalaApiController::class, 'listreplay']);
    Route::post('masalah/comment', [KendalaApiController::class, 'saveComment']);
    Route::put('masalah/update-replay/{id}', [KendalaApiController::class, 'updatereplay']);
    Route::post('masalah/selected', [KendalaApiController::class, 'masalahSelected']);
    Route::delete('masalah/delete-replay/{id}', [KendalaApiController::class, 'deletereplay']);
    Route::delete('masalah/delete-all/{id}', [KendalaApiController::class, 'deleteMasalah']);

    Route::get('forum', [ForumApiController::class, 'index']);
    Route::post('forum', [ForumApiController::class, 'store']);
    Route::post('forum/search', [ForumApiController::class, 'searchForum']);
    Route::put('forum/{id}', [ForumApiController::class, 'update']);
    Route::post('forum/selected', [ForumApiController::class, 'deleteForum']);
    Route::delete('forum/{id}', [ForumApiController::class, 'delete']);

    Route::get('topic/{id}', [ForumApiController::class, 'show']);
    Route::get('topic/comment/{id}', [ForumApiController::class, 'commentDetail']);
    Route::post('topic/search', [ForumApiController::class, 'searchTopic']);
    Route::post('topic', [ForumApiController::class, 'saveTopic']);
    Route::get('topic/list-replay/{id}', [ForumApiController::class, 'listreplay']);
    Route::post('topic/comment', [ForumApiController::class, 'saveComment']);
    Route::put('topic/update-replay/{id}', [ForumApiController::class, 'updatereplay']);
    Route::delete('topic/delete-replay/{id}', [ForumApiController::class, 'deletereplay']);
    Route::delete('topic/delete-all/{id}', [ForumApiController::class, 'deleteTopic']);
    Route::post('topic/selected', [ForumApiController::class, 'deleteSelected']);

    Route::get('notification', [NotificationApiController::class, 'index']);
    Route::get('notif', [NotificationApiController::class, 'show']);
    Route::put('notif-update/{id}', [NotificationApiController::class, 'update']);

    Route::get('menu', [MenusApiController::class, 'index']);
    Route::post('menu', [MenusApiController::class, 'store']);
    Route::post('menu/search', [MenusApiController::class, 'search']);
    Route::put('menu/{id}', [MenusApiController::class, 'update']);
    Route::delete('menu/{id}', [MenusApiController::class, 'delete']);

    Route::get('action', [ActionApiController::class, 'index']);
    Route::get('action/edit/{id}', [ActionApiController::class, 'edit']);
    Route::post('action', [ActionApiController::class, 'store']);
    Route::post('action/search', [ActionApiController::class, 'search']);
    Route::put('action/{id}', [ActionApiController::class, 'update']);
    Route::delete('action/{id}', [ActionApiController::class, 'delete']);
    Route::post('action/selected', [ActionApiController::class, 'deleteSelected']);

    Route::get('menu/role', [MenusApiController::class, 'menuRole']);
    Route::post('menu/role/save', [MenusRoleApiController::class, 'store']);
    Route::get('menu/action', [ActionApiController::class, 'actionList']);
    Route::delete('menu/role/{id}', [MenusRoleApiController::class, 'delete']);

    Route::get('kriteria', [KriteriaApiController::class, 'index']);
    Route::get('kriteria/edit/{id}', [KriteriaApiController::class, 'edit']);
    Route::post('kriteria', [KriteriaApiController::class, 'store']);
    Route::post('kriteria/search', [KriteriaApiController::class, 'search']);
    Route::put('kriteria/{id}', [KriteriaApiController::class, 'update']);
    Route::delete('kriteria/{id}', [KriteriaApiController::class, 'delete']);
    Route::post('kriteria/selected', [KriteriaApiController::class, 'deleteSelected']);

    Route::get('setting-apps', [SettingWebApiController::class, 'index']);
    Route::put('setting-apps/{id}', [SettingWebApiController::class, 'update']);

    Route::get('bimsos/datalist', [BimsosApiController::class, 'jsonData']);
    Route::post('bimsos', [BimsosApiController::class, 'store']);
    Route::get('bimsos/edit/{id}', [BimsosApiController::class, 'edit']);
    Route::post('bimsos/update/{id}', [BimsosApiController::class, 'update']);
    Route::post('bimsos/kirim/{id}', [BimsosApiController::class, 'update']);
    Route::delete('bimsos/{id}', [BimsosApiController::class, 'delete']);
    Route::post('bimsos/selected', [BimsosApiController::class, 'deleteSelected']);
    Route::put('bimsos/request_edit/{id}', [BimsosApiController::class, 'request_edit']);
    Route::put('bimsos/request_revisi/{id}', [BimsosApiController::class, 'request_revisi']);
    Route::put('bimsos/approve_edit/{id}', [BimsosApiController::class, 'approve_edit']);
    Route::post('bimsos/header', [BimsosApiController::class, 'header']);


    Route::post('penyelesaian', [PenyelesaianApiController::class, 'store']);
    Route::post('penyelesaian/selected', [PenyelesaianApiController::class, 'deleteSelected']);
    Route::post('penyelesaian/update/{id}', [PenyelesaianApiController::class, 'update']);
    Route::post('penyelesaian/kirim/{id}', [PenyelesaianApiController::class, 'update']);
    Route::get('penyelesaian/datalist', [PenyelesaianApiController::class, 'jsonData']);
    Route::post('penyelesaian/header', [PenyelesaianApiController::class, 'header']);
    Route::get('penyelesaian/edit/{id}', [PenyelesaianApiController::class, 'edit']);
    Route::get('penyelesaian/log/{id}', [PenyelesaianApiController::class, 'log']);
    Route::get('penyelesaian/cekPeriode/{id}', [PenyelesaianApiController::class, 'cekPeriode']);
    Route::put('penyelesaian/{id}', [PenyelesaianApiController::class, 'update']);
    Route::put('penyelesaian/request_edit/{id}', [PenyelesaianApiController::class, 'request_edit']);
    Route::put('penyelesaian/request_revisi/{id}', [PenyelesaianApiController::class, 'request_revisi']);
    Route::put('penyelesaian/approve_edit/{id}', [PenyelesaianApiController::class, 'approve_edit']);
    Route::delete('penyelesaian/{id}', [PenyelesaianApiController::class, 'delete']);

    Route::get('promosi', [PromosiApiController::class, 'index']);
    Route::post('promosi', [PromosiApiController::class, 'store']);
    Route::get('promosi/{id}', [PromosiApiController::class, 'show']);
    Route::put('promosi/{id}', [PromosiApiController::class, 'update']);
    Route::post('promosi/requestedit/{id}', [PromosiApiController::class, 'reqedit']);
    Route::put('promosi/{type}/{id}', [PromosiApiController::class, 'approved']);
    Route::post('promosi/selected', [PromosiApiController::class, 'deleteSelected']);
    Route::post('promosi/search', [PromosiApiController::class, 'search']);
    Route::delete('promosi/{id}', [PromosiApiController::class, 'delete']);


    Route::get('pemetaan', [PemetaanApiController::class, 'index']);
    Route::post('pemetaan', [PemetaanApiController::class, 'store']);
    Route::get('pemetaan/{id}', [PemetaanApiController::class, 'show']);
    Route::put('pemetaan/{id}', [PemetaanApiController::class, 'update']);
    Route::post('pemetaan/requestedit/{id}', [PemetaanApiController::class, 'reqedit']);
    Route::put('pemetaan/{type}/{id}', [PemetaanApiController::class, 'approved']);
    Route::post('pemetaan/selected', [PemetaanApiController::class, 'deleteSelected']);
    Route::post('pemetaan/search', [PemetaanApiController::class, 'search']);
    Route::delete('pemetaan/{id}', [PemetaanApiController::class, 'delete']);

    Route::get('wilayah', [WilayahApiController::class, 'index']);
    Route::get('wilayah/edit/{id}', [WilayahApiController::class, 'edit']);
    Route::post('wilayah', [WilayahApiController::class, 'store']);
    Route::post('wilayah/search', [WilayahApiController::class, 'search']);
    Route::put('wilayah/{id}', [WilayahApiController::class, 'update']);
    Route::delete('wilayah/{id}', [WilayahApiController::class, 'delete']);
    Route::post('wilayah/selected', [WilayahApiController::class, 'deleteSelected']);


    Route::get('rekapitulasi', [RekapitulasiApiController::class, 'index']);
    

    // Route::get('user/profile', [UserApiController::class, 'GetUserID']);
    // Route::post('user/update', [UserApiController::class, 'updateProfile']);
    // Route::post('user/status', [UserApiController::class, 'StatusConfirm']);
    // Route::post('user/sendmail', [UserApiController::class, 'sendMail']);
});
