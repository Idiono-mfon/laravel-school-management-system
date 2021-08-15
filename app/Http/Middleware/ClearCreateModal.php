<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClearCreateModal
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
        if (session("create_modal")) {
            session()->forget("create_modal");
            return $next($request);
        }

        return $next($request);
    }
}
