<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequirePermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        if (auth()->guest() or !auth()->user()->hasPermission($permission)) {
            abort(403);
        }

        return $next($request);
    }
}
