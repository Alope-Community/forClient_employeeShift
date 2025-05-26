<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfLoggedInWithDifferentRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $guards = ['employee', 'shift_leader', 'admin'];
        $currentGuard = null;

        // Cek semua guard, kalau sudah login di salah satu, simpan
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $currentGuard = $guard;
                break;
            }
        }

        // Jika sudah login di salah satu guard, dan ingin login ke role lain, tolak
        if ($currentGuard) {
            return redirect()->route($currentGuard . '.dashboard'); // arahkan ke dashboard sesuai guard
        }

        return $next($request);
    }
}
