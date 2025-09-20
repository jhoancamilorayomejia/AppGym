<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Usuarios</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: url('https://img.freepik.com/foto-gratis/vista-angulo-hombre-musculoso-irreconocible-preparandose-levantar-barra-club-salud_637285-2497.jpg?semt=ais_hybrid&w=740&q=80') no-repeat center center fixed;
      background-size: cover;
    }
    .fade-transition {
      transition: opacity .6s ease, transform .4s ease;
    }
  </style>
</head>
<body class="h-screen flex text-white">

  <!-- Sidebar -->
  <aside class="w-60 bg-black p-4 flex flex-col">
    <h2 class="text-base font-bold mb-6">Panel de Control</h2>
    <nav class="flex flex-col gap-2 text-xs">
      <div class="relative">
        <button id="adminButton" class="w-full text-left hover:bg-gray-800 rounded-md px-3 py-2 flex items-center justify-between">
          🏠 Administradores
          <span>▼</span>
        </button>
        <div id="adminMenu" class="hidden absolute left-0 mt-1 w-48 bg-gray-900 rounded-md shadow-lg z-50">
          <a href="{{ route('usuarios.index') }}" class="block px-4 py-2 text-sm hover:bg-gray-700">📋 Lista de Admin</a>
          <a href="{{ route('usuarios.create') }}" class="block px-4 py-2 text-sm hover:bg-gray-700">➕ Registrar Usuario</a>
        </div>
      </div>

      <a href="{{ route('customers.index') }}" class="hover:bg-gray-800 rounded-md px-3 py-2">👥 Clientes</a>

      <div class="relative mt-2">
        <button id="configButton" class="w-full text-left hover:bg-gray-800 rounded-md px-3 py-2 flex items-center justify-between">
          ⚙️ Configuración
          <span>▼</span>
        </button>
        <div id="configMenu" class="hidden absolute left-0 mt-1 w-48 bg-gray-900 rounded-md shadow-lg z-50">
          <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm hover:bg-gray-700">🚪 Cerrar sesión</a>
          <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-700">❓ Ayuda</a>
        </div>
      </div>
    </nav>
  </aside>

  <!-- Main content -->
  <main class="flex-1 flex items-start justify-center p-8 overflow-y-auto">
    <div class="bg-black bg-opacity-95 shadow-lg rounded-xl p-6 w-[1050px]">

      <h1 class="text-xl font-bold mb-6">Usuarios Registrados</h1>

      @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-green-600 text-white text-sm rounded-md shadow fade-transition">
          {{ session('success') }}
        </div>
      @endif

      @if($errors->any())
        <div class="mb-4 px-4 py-2 bg-red-600 text-white text-sm rounded-md shadow fade-transition">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="overflow-x-auto">
        <table class="w-full text-sm border border-gray-700 rounded-lg">
  <thead class="bg-gray-900">
    <tr>
      <th class="px-4 py-2 border border-gray-700">Usuario</th>
      <th class="px-4 py-2 border border-gray-700">Contraseña</th>
      <th class="px-4 py-2 border border-gray-700">Tipo</th>
      <th class="px-4 py-2 border border-gray-700">Acciones</th> <!-- Nueva columna -->
    </tr>
  </thead>
  <tbody class="bg-gray-800">
    @forelse($usuarios as $usuario)
      <tr class="hover:bg-gray-700">
        <td class="px-4 py-2 border border-gray-700">{{ $usuario->username }}</td>
        <td class="px-4 py-2 border border-gray-700">{{ $usuario->password }}</td>
        <td class="px-4 py-2 border border-gray-700">{{ $usuario->usertipo }}</td>
        <td class="px-4 py-2 border border-gray-700">
          <form action="{{ route('usuarios.destroy', $usuario->iduser) }}" method="POST" onsubmit="return confirm('¿Deseas eliminar este usuario?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 px-2 py-1 rounded text-xs hover:bg-red-800">Eliminar</button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="5" class="text-center py-4 text-gray-400">No hay usuarios registrados.</td>
      </tr>
    @endforelse
  </tbody>
</table>

      </div>

     <div class="flex justify-start gap-1 pt-4">
  <a href="{{ route('dashboard') }}" 
     class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2">
     ← Regresar
  </a>
</div>

    </div>
    
    
  </main>

  <script>
    // Toggle menú Admin
    const adminButton = document.getElementById("adminButton");
    const adminMenu = document.getElementById("adminMenu");

    adminButton.addEventListener("click", () => {
      adminMenu.classList.toggle("hidden");
    });

    // Toggle menú Configuración
    const configButton = document.getElementById("configButton");
    const configMenu = document.getElementById("configMenu");

    configButton.addEventListener("click", () => {
      configMenu.classList.toggle("hidden");
    });

    // Cerrar menús si se hace clic fuera
    document.addEventListener("click", (e) => {
      if (!adminButton.contains(e.target) && !adminMenu.contains(e.target)) {
        adminMenu.classList.add("hidden");
      }
      if (!configButton.contains(e.target) && !configMenu.contains(e.target)) {
        configMenu.classList.add("hidden");
      }
    });
  </script>

</body>
</html>
