<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Permission
{
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        if (!Auth::user() or !Auth::user()->role) {
            abort(404);
        }

        foreach($permissions as $permission){
            if (!Auth::user()->role->$permission){
                abort(403);
            }
        }

        return $next($request);
    }
}