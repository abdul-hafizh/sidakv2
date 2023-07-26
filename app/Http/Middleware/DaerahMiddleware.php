<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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

        
        if(empty($_COOKIE['access']))
        {
            return redirect()->to('login');
        }else if($_COOKIE['access'] != 'daerah'){
           abort(404);
            
        }   
        
      
       

        return $next($request);
    }
}
