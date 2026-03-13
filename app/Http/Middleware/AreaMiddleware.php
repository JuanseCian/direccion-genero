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

    // Admin siempre puede
    if ($user->rol_id == 2) {
        return $next($request);
    }

    // Si tiene acceso al área
    if ($user->areas()->where('nombre', $area)->exists()) {
        return $next($request);
    }

    // Caso especial para IVE: permitir si tiene casos asignados
    if ($area === 'ive' && $user->iveCasos()->exists()) {
        return $next($request);
    }

    abort(403,'No tiene permisos para esta área');
}
}
