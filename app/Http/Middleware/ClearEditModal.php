<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClearEditModal
{
    /**
     * Handle an incoming request.
     * Check whether class arm edit modal was previously trigger without subsequent completion
     * if true, clear out the edit modal trigger parameter from session
     *  This will make this to automatically disable the edit clas arm modal when initiating susequent request
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session("edit_modal")) {
            session()->forget("edit_modal");
            return $next($request);
        }
        return $next($request);
    }
}
