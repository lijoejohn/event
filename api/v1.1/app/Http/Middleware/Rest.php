<?php

namespace App\Http\Middleware;

use Closure;

class Rest
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
    	$request->attributes->add(['rest' => true]);
        return $next($request);
    }
}
