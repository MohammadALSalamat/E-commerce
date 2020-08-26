<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class adminDetailes
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
          if(empty(Session::has('AdminSession'))){
            return redirect('/admin');
        }
        return $next($request);
    }
}
