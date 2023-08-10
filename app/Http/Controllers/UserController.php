<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestUser;
use App\Http\Request\RequestDaerah;
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
       
        // $data = User::orderBy('id', 'ASC')->paginate($this->perPage)->onEachSide(0);
        // $result = RequestUser::GetDataAll($data,$this->perPage,$request);
        $list_daerah = RequestDaerah::GetDaerahID();
       

        return view('template/' . $this->template . '.user.index')
        ->with(
            [

              // 'result' => $result,
              'daerah' => $list_daerah,
             // 'paginate' => $data->links('vendor.pagination.default'),   
              'title' => 'Data User',
              'template'=>'template/'.$this->template
            ]);
    }

    
}
