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
          <a href="{{ route('usuarios.admins') }}" class="block px-4 py-2 text-sm hover:bg-gray-700">📋 Lista de Admin</a>
          <a href="{{ route('usuarios.create') }}" class="block px-4 py-2 text-sm hover:bg-gray-700">➕ Registrar Usuario</a>
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
    <div class="bg-black bg-opacity-95 shadow-lg rounded-xl p-6 w-[1200px]">

      

       <!-- Encabezado -->
    <div class="flex justify-between items-center mb-6 text-sm">
     <h1 class="text-xl font-bold mb-6">Administradores Registrados</h1>
      <div>
        <span class="mr-3">Usuario conectado: 
          <strong>{{ session('user')->username ?? 'Invitado' }}</strong>
        </span>
      </div>
    </div>

    

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
              <th class="px-4 py-2 border border-gray-700">Cédula</th>
              <th class="px-4 py-2 border border-gray-700">Usuario</th>
              <th class="px-4 py-2 border border-gray-700">Nombre</th>
              <th class="px-4 py-2 border border-gray-700">Apellido</th>
              <th class="px-4 py-2 border border-gray-700">Teléfono</th>
              <th class="px-4 py-2 border border-gray-700">Correo</th>
              <th class="px-4 py-2 border border-gray-700">Tipo de Usuario</th>
              <th class="px-4 py-2 border border-gray-700">Acciones</th>
            </tr>
          </thead>
          <tbody class="bg-gray-800">
            @forelse($usuarios as $usuario)
              <tr class="hover:bg-gray-700">
                <td class="px-4 py-2 border border-gray-700">{{ $usuario->cedula }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $usuario->username }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $usuario->name }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $usuario->lastname }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $usuario->phone }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $usuario->email }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $usuario->usertipo }}</td>
                <td class="px-4 py-2 border border-gray-700 flex gap-1">
    <!-- Botón Editar -->
    <button 
        onclick="openEditModal({{ $usuario->iduser }}, '{{ $usuario->username }}', '{{ $usuario->name }}', '{{ $usuario->lastname }}', '{{ $usuario->phone }}', '{{ $usuario->email }}')"
        class="bg-blue-600 px-2 py-1 rounded text-xs hover:bg-blue-800">Editar</button>

    <!-- Botón Eliminar -->
    <form action="{{ route('usuarios.destroyAdmin', $usuario->iduser) }}" method="POST" onsubmit="return confirm('¿Deseas eliminar este usuario Admin?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 px-2 py-1 rounded text-xs hover:bg-red-800">Eliminar</button>
    </form>
</td>
              </tr>
            @empty
              <tr>
                <td colspan="10" class="text-center py-4 text-gray-400">No hay usuarios registrados.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="flex justify-start gap-1 pt-4">
        <a href="{{ route('dashboard') }}" 
          class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2">
          ← Regresar al Menú
        </a>
      </div>

      <!-- Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-gray-900 rounded-lg p-6 w-96 relative">
        <h2 class="text-lg font-bold mb-4 text-white">Editar Usuario</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="block text-sm mb-1 text-white">Nombre de Usuario</label>
                <input type="text" name="username" id="editUsername" class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700" required>
            </div>

            <div class="mb-3">
                <label class="block text-sm mb-1 text-white">Nombre</label>
                <input type="text" name="name" id="editName" class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700" required>
            </div>

            <div class="mb-3">
                <label class="block text-sm mb-1 text-white">Apellido</label>
                <input type="text" name="lastname" id="editLastname" class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700" required>
            </div>

            <div class="mb-3">
                <label class="block text-sm mb-1 text-white">Teléfono</label>
                <input type="text" name="phone" id="editPhone" class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700">
            </div>

            <div class="mb-3">
                <label class="block text-sm mb-1 text-white">Correo</label>
                <input type="email" name="email" id="editEmail" class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700" required>
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeEditModal()" class="bg-gray-700 px-4 py-2 rounded hover:bg-gray-600 text-sm">Cancelar</button>
                <button type="submit" class="bg-green-600 px-4 py-2 rounded hover:bg-green-700 text-sm">Guardar</button>
            </div>
        </form>
    </div>
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

    // Desaparecer alertas automáticamente
    setTimeout(() => {
      document.querySelectorAll('.fade-transition').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(-10px)';
      });
    }, 3000);

    function openEditModal(id, username, name, lastname, phone, email) {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');

    form.action = `/usuarios/${id}`; // Ruta PUT para actualizar
    document.getElementById('editUsername').value = username;
    document.getElementById('editName').value = name;
    document.getElementById('editLastname').value = lastname;
    document.getElementById('editPhone').value = phone;
    document.getElementById('editEmail').value = email;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeEditModal() {
    const modal = document.getElementById('editModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

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
