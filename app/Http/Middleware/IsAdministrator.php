<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if( ! auth()->check() || ( auth()->check() && ! auth()->user()->isAdministrator() ) ) {
            return abort(404);
        }
        
        return $next($request);
    }
}
