<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        
        if (! Auth::check()) {
            abort(401);
        }
        $user = Auth::user();

        // if (! in_array(auth()->user()->role, $roles)) {
        //     abort(403);
        // }
        if (!$user || !in_array($user->role, $roles)) {
            abort(403);
        }
        return $next($request);
    }
}
