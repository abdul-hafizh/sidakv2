<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaerahMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        
      if(isset($_COOKIE['access']))
        {
            
            // if($_COOKIE['access'] != 'province')
            // {

            //     if($_COOKIE['access'] != 'pusat')
            //     {
            //        abort(404); 
            //     }    
            //    // 
               
            // }
        }else{

            Auth::logout();
            unset($_COOKIE['access']); 
            setcookie('access', '', -1, '/'); 
            setcookie('token', '', -1, '/');  
            return redirect('login');

        }
        
      
       

        return $next($request);
    }
}
