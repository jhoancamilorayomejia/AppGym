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
        return view('registeradmin'); // Aquí tienes que tener la vista del formulario
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
     $request->validate([
    'cedula'   => 'required|numeric|unique:usuarios,cedula',
    'name'     => 'required|string',
    'lastname' => 'required|string',
    'address'  => 'nullable|string',
    'phone'    => 'required|string', // ahora puede repetirse
    'email'    => 'required|email|unique:usuarios,email',
    'username' => 'required|string|unique:usuarios,username',
    'password' => 'required|confirmed|min:6',
    'usertipo' => 'required|in:AD,CL',
]);



       $usuario = Usuario::create([
    'cedula'   => $request->cedula,
    'username' => $request->username,
    'password' => Hash::make($request->password),
    'name'     => $request->name,
    'lastname' => $request->lastname,
    'phone'    => $request->phone,
    'email'    => $request->email,
    'usertipo' => $request->usertipo,
]);


    // Redirección según tipo de usuario
      if ($usuario->usertipo === 'AD') {
    return redirect()->route('usuarios.admins')
                     ->with('success', 'Administrador registrado correctamente');
} else {
    return redirect()->route('usuarios.index')
                     ->with('success', 'Cliente registrado correctamente');
}

}

 // Listar clientes
public function index()
{
    $usuarios = Usuario::where('usertipo', 'CL')->get();
    return view('table', compact('usuarios'));
}


  public function indexAdmin()
{
    $usuarios = Usuario::where('usertipo', 'AD')->get();
    return view('tableadmin', compact('usuarios'));
}



    // Eliminar cliente
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario eliminado correctamente');
    }


    //eliminar admin
    public function destroyAdmin($id)
{
    $usuario = Usuario::findOrFail($id);
    $usuario->delete();

    return redirect()->route('usuarios.admins')
             ->with('success', 'Usuario Admin eliminado correctamente');
}

public function update(Request $request, $id)
{
    $usuario = Usuario::findOrFail($id);

    $request->validate([
        'username' => 'required|string|max:50|unique:usuarios,username,' . $usuario->iduser . ',iduser',
        'name'     => 'required|string|max:100',
        'lastname' => 'required|string|max:100',
        'phone'    => 'nullable|string|max:20',
        'email'    => 'required|email|unique:usuarios,email,' . $usuario->iduser . ',iduser',
    ]);

    $usuario->update($request->only('username', 'name', 'lastname', 'phone', 'email'));

    return redirect()->back()->with('success', 'Usuario actualizado correctamente');

    
}

public function updateuser(Request $request, $id)
{
    $usuario = Usuario::findOrFail($id);

    $request->validate([
        'username' => 'required|string|max:50|unique:usuarios,username,' . $usuario->iduser . ',iduser',
        'name'     => 'required|string|max:100',
        'lastname' => 'required|string|max:100',
        'phone'    => 'nullable|string|max:20',
        'email'    => 'required|email|unique:usuarios,email,' . $usuario->iduser . ',iduser',
    ]);

    $usuario->update($request->only('username', 'name', 'lastname', 'phone', 'email'));

    return redirect()->back()->with('success', 'Usuario actualizado correctamente');
}


}
