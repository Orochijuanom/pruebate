<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use Response;

class CheckEstudiante
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
            if (Auth::user()->role_id != 3) {
                return response::view('errors/401',array() ,401);
            }
        }else{
            return redirect()->guest('login');
        }

        return $next($request);
    }
}
