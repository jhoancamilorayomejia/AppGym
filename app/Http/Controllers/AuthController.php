<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class AuthController extends Controller
{
    // Mostrar el formulario de login
    public function showLogin()
    {
        return view('welcome'); 
    }

    // Procesar login
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $user = Usuario::where('username', $credentials['username'])
                       ->where('password', $credentials['password']) // ⚠️ sin hash aún
                       ->first();

        if ($user) {
            
            $request->session()->put('user', $user);

            return redirect()->route('dashboard');
        } else {
            return back()->withErrors(['login' => 'Usuario o contraseña incorrectos']);
        }
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->flush();

        return redirect()->route('login');
    }
}
