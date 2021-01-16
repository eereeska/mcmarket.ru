<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLastSeen
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            User::where('id', Auth::user()->id)->update(['last_seen_at' => now()]);
        }

        return $next($request);
    }
}
