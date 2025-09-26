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



    <!-- Clientes -->
    <a href="{{ route('planes.index', ['iduser' => session('user')->iduser]) }}" 
   class="hover:bg-gray-800 rounded-md px-3 py-2">
  📅 Historial de Pagos
</a>


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
  <div class="bg-black bg-opacity-95 shadow-lg rounded-xl p-6 w-[950px]">

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
    <div class="flex gap-3 mb-6">
      <a href="{{ route('registercustomer') }}" 
         class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg text-sm font-semibold inline-block">
        Productos en Venta
      </a>
      
      <a href="{{ route('usuarios.index') }}"
         class="bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
        Agregar un Producto Nuevo
      </a>
    </div>

    <!-- Productos en venta -->
    <h2 class="text-lg font-bold mb-4">💪 Suplementos Disponibles</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      
      <!-- Producto 1 -->
      <div class="bg-gray-900 rounded-xl shadow-md p-4 flex flex-col items-center text-center hover:scale-105 transition">
        <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" 
             alt="Proteína" class="w-20 h-20 mb-3">
        <h3 class="text-lg font-semibold">Proteína Whey</h3>
        <p class="text-sm text-gray-400 mb-2">Aumenta masa muscular y recuperación.</p>
        <span class="text-green-500 font-bold mb-3">$120.000</span>
        <button class="bg-blue-600 hover:bg-blue-800 px-4 py-2 rounded-lg text-sm">🛒 Comprar</button>
      </div>

      <!-- Producto 2 -->
      <div class="bg-gray-900 rounded-xl shadow-md p-4 flex flex-col items-center text-center hover:scale-105 transition">
        <img src="https://cdn-icons-png.flaticon.com/512/1046/1046790.png" 
             alt="Creatina" class="w-20 h-20 mb-3">
        <h3 class="text-lg font-semibold">Creatina</h3>
        <p class="text-sm text-gray-400 mb-2">Mejora fuerza y rendimiento físico.</p>
        <span class="text-green-500 font-bold mb-3">$90.000</span>
        <button class="bg-blue-600 hover:bg-blue-800 px-4 py-2 rounded-lg text-sm">🛒 Comprar</button>
      </div>

      <!-- Producto 3 -->
      <div class="bg-gray-900 rounded-xl shadow-md p-4 flex flex-col items-center text-center hover:scale-105 transition">
        <img src="https://cdn-icons-png.flaticon.com/512/1046/1046766.png" 
             alt="Linimento" class="w-20 h-20 mb-3">
        <h3 class="text-lg font-semibold">Linimento</h3>
        <p class="text-sm text-gray-400 mb-2">Alivia dolores musculares y articulares.</p>
        <span class="text-green-500 font-bold mb-3">$25.000</span>
        <button class="bg-blue-600 hover:bg-blue-800 px-4 py-2 rounded-lg text-sm">🛒 Comprar</button>
      </div>

    </div>
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
