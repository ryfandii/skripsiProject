<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekStatusUser
{
        public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user && $user->guru && $user->guru->status !== 'aktif') {
            auth()->logout();

            return redirect('/login')
                ->with('error', 'Akun anda dinonaktifkan');
        }

        return $next($request);
    }
}
