<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class UserLastSeen
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() and !$request->expectsJson()) {
            User::where('id', auth()->id())->update(['last_seen_at' => now()]);
        }

        return $next($request);
    }
}
