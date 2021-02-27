<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Permission
{
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        if (!auth()->user() or !auth()->user()->role) {
            abort(404);
        }

        foreach($permissions as $permission){
            if (!auth()->user()->role->$permission){
                abort(403);
            }
        }

        return $next($request);
    }
}