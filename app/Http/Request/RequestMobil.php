<?php

namespace App\Http\Request;

use Auth;
use App\Helpers\GeneralHelpers;
use App\Models\Mobil;
use Illuminate\Support\Str;

class RequestMobil
{

  public static function GetDataAll($data, $perPage, $request, $description)
  {
    $__temp_ = array();
    $getRequest = $request->all();
    $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
    $numberNext = (($page * $perPage) - ($perPage - 1));
    foreach ($data as $key => $val) {

      $__temp_[$key]['number'] = $numberNext++;
      $__temp_[$key]['merk'] = $val->merk;
      $__temp_[$key]['type'] = $val->type;
      $__temp_[$key]['created_at'] = GeneralHelpers::tanggal_indo($val['created_at']);
    }


    $results['result'] = $__temp_;
    if ($description != "") {
      if ($data->total() != 0) {
        $results['cari'] = 'Pencarian "' . $description . '" berhasil ditemukan';
      } else {
        $results['cari'] = 'Pencarian tidak ditemukan "' . $description . '" ';
      }
    } else {
      $results['cari'] = '';
    }
    $results['total'] = $data->total();
    $results['lastPage'] = $data->lastPage();
    $results['perPage'] = $data->perPage();
    $results['currentPage'] = $data->currentPage();
    $results['nextPageUrl'] = $data->nextPageUrl();
    return $results;
  }

  public static function GetDataID($data)
  {

    $__temp_['id'] = $data->id;
    $__temp_['name'] = $data->name;
    $__temp_['status'] = $data->status;

    return $__temp_;
  }



  public static function fieldsData($request)
  {
    $uuid = Str::uuid()->toString();
    $fields = [
      'id' => $uuid,
      'merk'  =>  $request->merk,
      'type'  =>  $request->type,
      'created_by' => Auth::User()->username,
      'created_at' => date('Y-m-d H:i:s'),
    ];
    return $fields;
  }

  public static function MidlewareDynamic()
  {
    $arr = array();
    $routeMiddleware = [
      'auth' => \App\Http\Middleware\Authenticate::class,
      'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
      'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
      'can' => \Illuminate\Auth\Middleware\Authorize::class,
      'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
      'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
      'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
      'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
      'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
      'jwt.auth' => \Tymon\JWTAuth\Middleware\GetUserFromToken::class,
      'jwt.refresh' => \Tymon\JWTAuth\Middleware\RefreshToken::class,
      // 'admin' => \App\Http\Middleware\AdminMiddleware::class,
      // 'daerah' => \App\Http\Middleware\DaerahMiddleware::class,
      // 'provinsi' => \App\Http\Middleware\ProvinsiMiddleware::class, 

    ];
    // $data = Roles::get();
    // foreach($data as $key => $value)
    // {
    //     $arr[$key][$value->slug] = '\App\Http\Middleware\''.$value->name.'Middleware::class';   

    // }

    return $routeMiddleware;
  }
}
