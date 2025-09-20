<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Mostrar formulario de registro
    public function create()
    {
        return view('registeradmin');
    }

    // Guardar nuevo administrador
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|confirmed',
            'usertipo' => 'required|in:AD,CL',
        ]);

        Usuario::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Contraseña encriptada
            'usertipo' => $request->usertipo
        ]);

        return redirect()->route('usuarios.create')
                         ->with('success', 'Administrador registrado correctamente');
    }

    // Listar usuarios
    public function index()
    {
        $usuarios = Usuario::all();
        return view('table', compact('usuarios'));
    }

    // Eliminar usuario
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario eliminado correctamente');
    }
}
