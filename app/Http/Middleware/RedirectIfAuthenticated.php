<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            return match (Auth::user()->role) {
                'ketua_tim' => redirect()->route('dashboard.ketua'),
                'dosen'     => redirect()->route('dashboard.dosen'),
                default     => redirect()->route('dashboard.mahasiswa'),
            };
        }
        return $next($request);
    }
}
