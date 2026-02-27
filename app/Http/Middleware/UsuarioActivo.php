<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioActivo
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->rol_id == 3) {

            Auth::logout();

            return redirect()->route('login')
                ->with('error','Usuario pendiente de autorización');
        }

        return $next($request);
    }
}