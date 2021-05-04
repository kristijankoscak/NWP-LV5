<?php

namespace App\Http\Middleware;

use Closure;

class ProfessorMiddleware
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
        if($request->user()->role != 'Professor'){
            return redirect('/home');
        }
        return $next($request);
    }
}
