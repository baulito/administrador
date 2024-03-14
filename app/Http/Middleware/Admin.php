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
        /*echo "<pre>";
        print_r(Session::all());
        echo "</pre>";*/
        $usuario = Session::get('usuario');
        if(isset($usuario) && $usuario->user_id >0 ){
            return $next($request);
        } else {
            Session::put('previous_url', url()->previous());
            //echo "no login";
            return redirect()->guest('login');
        }

       
    }
}
