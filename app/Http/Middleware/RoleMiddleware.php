<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Pass role(s) as parameter(s), e.g. 'admin' or 'admin|kasir'
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $allowed = explode('|', $roles);

        if (!in_array($user->role, $allowed)) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
