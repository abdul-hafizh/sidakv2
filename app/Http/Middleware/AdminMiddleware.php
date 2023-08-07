<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
           
            if (Auth::check())
            {
               
                if($_COOKIE['access'] != 'admin')
                {
                   abort(404); 
                }

              

            }
            
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
