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
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\KendalaController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OptionsController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\BimsosController;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'store']);

Route::post('/forgotpasword', [AuthController::class, 'ForgotPassword']);
Route::post('/checktoken', [AuthController::class, 'CheckToken']);
Route::post('/updatepassword', [AuthController::class, 'UpdatePassword']);
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/perencanaan', [PerencanaanController::class, 'index']);
    Route::get('/perencanaan/add', [PerencanaanController::class, 'add']);
    Route::get('/perencanaan/edit/{id}', [PerencanaanController::class, 'edit']);
    Route::get('/perencanaan/detail/{id}', [PerencanaanController::class, 'show']);
    Route::get('/perencanaan/generate_pdf/{id}', [PerencanaanController::class, 'generate_pdf']);
    Route::get('/pagutarget', [PaguTargetController::class, 'index']);
    Route::get('/kendala', [KendalaController::class, 'index']);
    Route::get('/kendala/{topic}', [KendalaController::class, 'show']);
    Route::get('/forum', [ForumController::class, 'index']);
    Route::get('/forum/{topic}', [ForumController::class, 'show']);
    Route::get('/notification', [NotificationController::class, 'index']);
    Route::get('/bimsos', [BimsosController::class, 'index']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/user',  [UserController::class, 'index']);
    Route::get('/role', [RoleController::class, 'index']);
    Route::get('/apps', [SettingWebController::class, 'index']);
    Route::get('/kriteria-kendala', [KriteriaController::class, 'index']);
    Route::get('/provinsi', [ProvinceController::class, 'index']);
    Route::get('/kabupaten', [RegencyController::class, 'index']);
    Route::get('/periode', [PeriodeController::class, 'index']);
    Route::get('/auditlog', [AuditLogController::class, 'index']);
    Route::get('/options', [OptionsController::class, 'index']);
    Route::get('/action', [ActionController::class, 'index']);
});

Route::middleware(['auth', 'pusat'])->group(function () {
});

Route::middleware(['auth', 'province'])->group(function () {
});

Route::middleware(['auth', 'daerah'])->group(function () {
});

Route::get('/logout', function () {
    Auth::logout();
    setcookie('token', '', -1, '/');
    setcookie('access', '', -1, '/');
    return redirect('login');
});
