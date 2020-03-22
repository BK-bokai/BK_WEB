<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Session;

class checkLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            Session::put('isLogin', True);
            $user = Auth::user();
            if($user->admin){
                Session::put('isAdmin', True);
            }
            else{
                Session::put('isAdmin', False);
            }
        }
        else{
            Session::put('isLogin', False);
            Session::put('isAdmin', False);
        }
        return $next($request);
    }
}
