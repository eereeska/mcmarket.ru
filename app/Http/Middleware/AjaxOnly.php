<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AjaxOnly
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->ajax()) {
            return back();
        }
        
        return $next($request);
    }
}