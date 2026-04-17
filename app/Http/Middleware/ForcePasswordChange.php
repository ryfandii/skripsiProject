<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForcePasswordChange
{
   public function handle(Request $request, Closure $next)
{
    $user = Auth::user();

    if ($user && $user->is_default_password) {

        if (!$request->is('force-password') && !$request->is('force-password/*')) {
            return redirect()->route('force.password');
        }
    }

    return $next($request);
}
    
}