<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AreaMiddleware
{
    public function handle($request, Closure $next, $area)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (!$user->areas()->where('nombre', $area)->exists()) {

            abort(403,'No tiene permisos para esta área');
        }

        return $next($request);
    }
}
