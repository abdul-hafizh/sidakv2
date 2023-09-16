<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestUser;
use App\Http\Request\RequestDaerah;
use App\Http\Request\RequestSystemLog;
use App\Helpers\GeneralPaginate;
use App\Models\User;
use Auth;

class UserController extends Controller
{

    public function __construct()
    {
      
        $this->template = RequestSettingApps::AppsTemplate();
        $this->perPage = GeneralPaginate::limit();
    }

    public function index(Request $request)
    {
       $title = 'Data User';
       $log = array(             
            'menu'=> $title,
            'slug'=>'user',
            'url'=>'user'
        );
        RequestSystemLog::CreateLog($log);

        // $query = User::select('id','username','daerah_id','name','email','phone','nip','leader_name','leader_nip','status','created_at')->orderBy('created_at', 'DESC')->get();
        // $result = RequestUser::GetDataPrint($query);
       

        return view('template/' . $this->template . '.user.index')
        ->with(
            [
              'title' =>  $title,
              // 'data' => $result,
              'template'=>'template/'.$this->template
            ]);
    }

    
}
