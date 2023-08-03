<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\Validation\ValidationAuth;
use App\Http\Request\RequestAuth;

use App\Models\User;
use App\Models\RoleUser;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   
   
    public function __construct()
    {
        $this->title = 'Login';
        $this->template = RequestSettingApps::AppsTemplate();
    }

    public function index(Request $request)
    {
        
        return view('template/' . $this->template . '.auth.login')
        ->with(
            [
              'title' => $this->title,
              'template'=>'template/'.$this->template
            ]);
    }

    public function store(Request $request)
    {

        $credentials = $request->only('username', 'password');
         RequestAuth::requestHash($request->username,$request->password); 
        $validation = ValidationAuth::validation($request);
        
        if($validation)
        {
            
           return view('template/' . $this->template . '.auth.login')
            ->with(
            [
              'title' => $this->title,
              'template'=>'template/'.$this->template,
              'errors'=>$validation,
            ]);

        }else{
         
          if (Auth::attempt($credentials)) {
            // Authentication successful
               $auth = Auth::User();
               $RoleUser = RoleUser::where('user_id',$auth->id)->first();
               $access =  $RoleUser->role->slug; 
               setcookie('access', $access, time() + (86400 * 30), "/"); // 86400 = 1 day
               return redirect('dashboard');
        } else {
            // Authentication failed
            return redirect()->route('login')->with('error', 'Invalid credentials');
        }
        
       }    
      
    }


   
}
