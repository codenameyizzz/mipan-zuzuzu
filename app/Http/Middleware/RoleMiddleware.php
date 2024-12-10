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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            // Jika belum login, redirect ke login
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->role !== $role && $user->Mahasiswa->angkatan > 2020) {
            // Jika role tidak sesuai, tampilkan halaman 403 Forbidden
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
