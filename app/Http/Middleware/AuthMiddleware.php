<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Verificamos si el middleware se está ejecutando
        // Si esto NO aparece al entrar a /dashboard, el middleware no se está aplicando
        // dd('Middleware ejecutado'); 

        if (!$request->session()->has('user')) {
            return redirect()->route('login')
                             ->withErrors(['login' => 'Debes iniciar sesión para acceder.']);
        }

        return $next($request);
    }
}

