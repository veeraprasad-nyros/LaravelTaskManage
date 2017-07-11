<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;

class RolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $guard = null)
    {
        if(Auth::guard($guard)->guest()){
            return redirect()->guest('login');
        }
        //print_r(Auth::user()->role_id);
        $rolename = Role::where('name', '=', $role)->first();
        //print_r($rolename->id);
        if(Auth::user()->role_id != $rolename->id)
        {
            return redirect()->guest('login');
        }
        return $next($request);
    }
}
