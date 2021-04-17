<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    public function handle(Request $request, Closure $next, $role)
    {
        $check = 'is_' . $role;

        if (auth()->guest() or !auth()->user()->$check) {
            abort(404);
        }

        return $next($request);
    }
}
