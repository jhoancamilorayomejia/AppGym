<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

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
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = Usuario::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Guardar usuario en sesión
            $request->session()->put('user', $user);

            // Redirigir según tipo de usuario
            if ($user->usertipo === 'AD') {
                return redirect()->route('dashboard'); // Dashboard normal
            } elseif ($user->usertipo === 'CL') {
                return redirect()->route('dashboarduser'); // Nuevo dashboard para cliente
            }
        }

        return back()->withErrors(['login' => 'Usuario o contraseña incorrectos']);
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->flush();

        return redirect()->route('login');
    }
}
