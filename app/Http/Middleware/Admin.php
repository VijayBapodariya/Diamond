<?php

namespace App\Http\Middleware;

use Closure;
use Session;

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
        if(Session::has('username') && Session::get('role')=="Admin"){
            return $next($request);
        }elseif(Session::has('username') && Session::get('role')=="superdistributer"){
            return redirect('/superdistributer');
        }elseif(Session::has('username') && Session::get('role')=="distributer"){
            return redirect('/distributer');
        }elseif(Session::has('username') && Session::get('role')=="retailer"){
            return redirect('/retailer');
        }else{
            return redirect('/login');
        }
    }
}
