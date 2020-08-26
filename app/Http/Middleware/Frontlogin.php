<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Frontlogin
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
        // create condtion to all users that has not register yet to force them to back to register before do other actions
        if(empty(Session::has('frontsession'))){
            return redirect('/Frontregister');
        }
        return $next($request);
    }
}
