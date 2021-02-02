<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Permission
{
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        if (!Auth::user() or !Auth::user()->role or !Auth::user()->role->permissions) {
            abort(404);
        }

        foreach($permissions as $permission){
            if (!Auth::user()->role->permissions->$permission){
                abort(403, 'p');
            }
        }

        return $next($request);
    }
}