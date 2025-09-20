<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <a href="{{ route('usuarios.index') }}" 
   class="block px-4 py-2 text-sm hover:bg-gray-700">
   📋 Lista de Admin
</a>

        <a href="{{ route('usuarios.create') }}" 
           class="block px-4 py-2 text-sm hover:bg-gray-700">
           ➕ Registrar Usuario
        </a>
      </div>
    </div>

    <!-- Clientes -->
    <a href="{{ route('customers.index') }}" class="hover:bg-gray-800 rounded-md px-3 py-2">👥 Clientes</a>

    <!-- Configuración con submenú -->
    <div class="relative mt-2">
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

    <!-- Encabezado -->
    <div class="flex justify-between items-center mb-6 text-sm">
      <h1 class="text-xl font-bold">Sistema de Gestión para Clientes</h1>
      <div>
        <span class="mr-3">Usuario conectado: 
          <strong>{{ session('user')->username ?? 'Invitado' }}</strong>
        </span>
      </div>
    </div>

    <!-- Botones de acciones -->
    <div class="flex gap-3 mb-4">
      <a href="{{ route('registercustomer') }}" 
         class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg text-sm font-semibold inline-block">
        Registrar Cliente Nuevo
      </a>
      
      <a href="{{ route('customers.index') }}"
         class="bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
        Ver Clientes Registrados
      </a>
    </div>

    <!-- Aquí puedes agregar más contenido o widgets de dashboard -->

  </div>
</main>

<!-- Scripts para los menús desplegables -->
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
  
</script>

</body>
</html>
