<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleCheck
{
    public function handle($request, Closure $next, $rol)
    {
        if (!Auth::check() || Auth::user()->rol < $rol) {
            abort(403, 'Niet toegestaan');
        }

        return $next($request);
    }
}
