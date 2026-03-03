<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $login = $request->input('login');

        // Detecta si es email o username
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL)
                        ? 'email'
                        : 'username';

        if (!Auth::attempt([
            $fieldType => $login,
            'password' => $request->password
        ])) {
            return back()->with('error','Usuario o contraseña incorrectos');
        }

        $request->session()->regenerate();

        return redirect()->route('home')
            ->with('success','Bienvenido '.auth()->user()->nombre.' 👋');
    }
        

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
