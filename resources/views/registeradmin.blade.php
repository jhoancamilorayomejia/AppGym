<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Administrador</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: url('https://img.freepik.com/foto-gratis/vista-angulo-hombre-musculoso-irreconocible-preparandose-levantar-barra-club-salud_637285-2497.jpg?semt=ais_hybrid&w=740&q=80') no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>
<body class="h-screen flex text-white">

<!-- Sidebar -->
<aside class="w-60 bg-black p-4 flex flex-col">
  <h2 class="text-base font-bold mb-6">Panel de Control</h2>
  <nav class="flex flex-col gap-2 text-xs">
    <!-- Administradores con submenú -->
    <div class="relative">
      <button id="adminButton" 
              class="w-full text-left hover:bg-gray-800 rounded-md px-3 py-2 flex items-center justify-between">
        🏠 Administradores
        <span>▼</span>
      </button>
      <div id="adminMenu" class="hidden absolute left-0 mt-1 w-52 bg-gray-900 rounded-md shadow-lg z-50">
        <a href="{{ route('usuarios.admins') }}" 
   class="block px-4 py-2 text-sm hover:bg-gray-700">
   📋 Lista de Admin
</a>

        <a href="{{ route('usuarios.create') }}" 
           class="block px-4 py-2 text-sm hover:bg-gray-700">
           ➕ Registrar Usuario
        </a>
      </div>
    </div>

     <!-- Clientes con submenú -->
<div class="relative mt-2">
  <button id="clientsButton" 
          class="w-full text-left hover:bg-gray-800 rounded-md px-3 py-2 flex items-center justify-between">
    👥 Clientes
    <span>▼</span>
  </button>
  <div id="clientsMenu" class="hidden absolute left-0 mt-1 w-52 bg-gray-900 rounded-md shadow-lg z-50">
    <a href="{{ route('customers.index') }}" 
       class="block px-4 py-2 text-sm hover:bg-gray-700">
       📋 Lista de Clientes
    </a>
    <a href="{{ route('usuarios.create') }}" 
       class="block px-4 py-2 text-sm hover:bg-gray-700">
       ➕ Agregar Cliente
    </a>
  </div>
</div>
    <!--a href="#" class="hover:bg-gray-800 rounded-md px-3 py-2">💳 Pagos</a-->

    <!-- Configuración con submenú -->
    <div class="relative">
      <button id="configButton" 
              class="w-full text-left hover:bg-gray-800 rounded-md px-3 py-2 flex items-center justify-between">
        ⚙️ Configuración
        <span>▼</span>
      </button>
      <div id="configMenu" class="hidden absolute left-0 mt-1 w-48 bg-gray-900 rounded-md shadow-lg z-50">
        <a href="{{ route('logout') }}" 
           class="block px-4 py-2 text-sm hover:bg-gray-700">
           🚪 Cerrar sesión
        </a>
        <a href="#" 
           class="block px-4 py-2 text-sm hover:bg-gray-700">
           ❓ Ayuda
        </a>
      </div>
    </div>
  </nav>
</aside>

<!-- Contenido principal -->
<main class="flex-1 flex items-start justify-center p-8 overflow-y-auto">
  <div class="bg-black bg-opacity-95 shadow-lg rounded-xl p-6 w-[850px]">
      <h1 class="text-xl font-bold text-center mb-6">Registro de Usuarios</h1>

      @if(session('success'))
        <div class="bg-green-600 text-white p-2 rounded mb-4">
          {{ session('success') }}
        </div>
      @endif

      @if($errors->any())
        <div class="bg-red-600 text-white p-2 rounded mb-4">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('usuarios.store') }}" class="space-y-4">
    @csrf

    <div>
        <label class="block text-sm mb-1">Cédula</label>
        <input type="text" name="cedula" required
               class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700">
    </div>

    <div>
        <label class="block text-sm mb-1">Nombre</label>
        <input type="text" name="name" required
               class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700">
    </div>

    <div>
        <label class="block text-sm mb-1">Apellido</label>
        <input type="text" name="lastname" required
               class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700">
    </div>

    <div>
        <label class="block text-sm mb-1">Teléfono</label>
        <input type="text" name="phone" required
               class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700">
    </div>

    <div>
        <label class="block text-sm mb-1">Correo electrónico</label>
        <input type="email" name="email" required
               class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700">
    </div>

    <div>
        <label class="block text-sm mb-1">Nombre de Usuario</label>
        <input type="text" name="username" required
               class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700">
    </div>

    <div>
        <label class="block text-sm mb-1">Contraseña</label>
        <input type="password" name="password" required
               class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700">
    </div>

    <div>
        <label class="block text-sm mb-1">Confirmar Contraseña</label>
        <input type="password" name="password_confirmation" required
               class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700">
    </div>

    <div>
        <label class="block text-sm mb-1">Tipo de Usuario</label>
        <select name="usertipo" class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700" required>
            <option value="" disabled selected>Seleccione la categoría</option>
            <option value="AD">Administrador</option>
            <option value="CL">Cliente</option>
        </select>
    </div>

    <div class="flex justify-end gap-3 pt-4">
        <a href="{{ route('dashboard') }}" 
           class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded-lg text-sm font-semibold">
           Cancelar
        </a>
        <button type="submit" 
                class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg text-sm font-semibold">
            Guardar
        </button>
    </div>
</form>

    </div>
  </main>

  <script>
      // Menú configuración
  const configButton = document.getElementById("configButton");
  const configMenu = document.getElementById("configMenu");

  configButton.addEventListener("click", () => {
    configMenu.classList.toggle("hidden");
  });

  // Menú administradores
  const adminButton = document.getElementById("adminButton");
  const adminMenu = document.getElementById("adminMenu");

  adminButton.addEventListener("click", () => {
    adminMenu.classList.toggle("hidden");
  });

  // Cerrar menús al hacer clic fuera
  document.addEventListener("click", (e) => {
    if (!configButton.contains(e.target) && !configMenu.contains(e.target)) {
      configMenu.classList.add("hidden");
    }
    if (!adminButton.contains(e.target) && !adminMenu.contains(e.target)) {
      adminMenu.classList.add("hidden");
    }
  });

   // Menú clientes
const clientsButton = document.getElementById("clientsButton");
const clientsMenu = document.getElementById("clientsMenu");

clientsButton.addEventListener("click", () => {
  clientsMenu.classList.toggle("hidden");
});

// Cerrar menús al hacer clic fuera
document.addEventListener("click", (e) => {
  if (!configButton.contains(e.target) && !configMenu.contains(e.target)) {
    configMenu.classList.add("hidden");
  }
  if (!adminButton.contains(e.target) && !adminMenu.contains(e.target)) {
    adminMenu.classList.add("hidden");
  }
  if (!clientsButton.contains(e.target) && !clientsMenu.contains(e.target)) {
    clientsMenu.classList.add("hidden");
  }
});
  </script>

</body>
</html>
