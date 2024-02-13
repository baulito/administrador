<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class Admin
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
        $usuario = Session::get('usuario');
        if(isset($usuario) && $usuario->user_id >0 ){
            return $next($request);
        } else {
            //echo "no login";
            return redirect()->guest('login');
        }

       
    }
}
