<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Request\RequestMenuRoles;
use App\Models\Roles;

class AuthRoleMiddleware
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
        
       if(!empty($_COOKIE['access']))
       {
            $access = Roles::where('slug',$_COOKIE['access'])->first();
            $menu = RequestMenuRoles::Roles($access->id);
            $data = json_decode($menu);
            $result = RequestMenuRoles::RoleTasks($data);
            $check = RequestMenuRoles::CheckMenuRole($result);
             
            // if($check ==false)
            // {
            //    abort(404);
            // }
                

           
       

       }else{
          return redirect()->to('login');
       }  


        return $next($request);
    }
}
