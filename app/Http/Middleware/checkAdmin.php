<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Session;

class checkAdmin
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
        $user = Auth::user();
        if($user->admin){
            Session::put('isAdmin', True);
        }
        else{
            Session::put('isAdmin', False);
            throw new \Symfony\Component\HttpKernel\Exception\HttpException(404);
        }
        return $next($request);
    }
}
