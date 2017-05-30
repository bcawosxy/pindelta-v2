<?php

namespace App\Http\Middleware;

use Closure;

class TestMiddleware
{
    public function __construct() {
//        $this->middleware('auth');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return redirect()->route('login');

//        return $next($request);
    }
}
