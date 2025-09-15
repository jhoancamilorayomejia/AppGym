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


<aside class="w-60 bg-black p-4 flex flex-col">
  <h2 class="text-base font-bold mb-6">Dashboard</h2>
  <nav class="flex flex-col gap-2 text-xs">
    <a href="#" class="hover:bg-gray-800 rounded-md px-3 py-2">🏠 Dashboard</a>
    <a href="#" class="hover:bg-gray-800 rounded-md px-3 py-2">👥 Clientes</a>
    <a href="#" class="hover:bg-gray-800 rounded-md px-3 py-2">💳 Pagos</a>
    <a href="#" class="hover:bg-gray-800 rounded-md px-3 py-2">⚙️ Configuración</a>
  </nav>
</aside>


 
  <main class="flex-1 flex items-start justify-center p-8 overflow-y-auto">

  
    <div class="bg-black bg-opacity-95 shadow-lg rounded-xl p-6 w-[850px]">

      
      <div class="flex justify-between items-center mb-6 text-sm">
        <h1 class="text-xl font-bold">Panel de Control</h1>
        <div>
          <span class="mr-3">Usuario conectado: 
            <strong>{{ session('user')->username ?? 'Invitado' }}</strong>
          </span>
          <a href="{{ route('logout') }}" 
             class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md">
             Cerrar sesión
          </a>
        </div>
      </div>

     
      <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-green-900 rounded-xl p-4 text-center shadow-md">
          <h2 class="text-sm font-semibold mb-1">Clientes Activos</h2>
          <p class="text-2xl font-bold">321</p>
        </div>
        <div class="bg-red-900 rounded-xl p-4 text-center shadow-md">
          <h2 class="text-sm font-semibold mb-1">Pagos Pendientes</h2>
          <p class="text-2xl font-bold">28</p>
        </div>
        <div class="bg-blue-900 rounded-xl p-4 text-center shadow-md">
          <h2 class="text-sm font-semibold mb-1">Nuevos Clientes (Mes)</h2>
          <p class="text-2xl font-bold">35</p>
        </div>
      </div>


      
<div class="flex gap-3">
  <a href="registercustomer" 
     class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg text-sm font-semibold inline-block">
    Registrar Cliente Nuevo
  </a>
  
  <a href="{{ route('customers.index') }}"
               class="bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                Ver Clientes Registrados
            </a>



    </div>
  </main>

  <!-- Scripts para gráficos -->
  <script>
    // Gráfico circular
    new Chart(document.getElementById('pieChart'), {
      type: 'doughnut',
      data: {
        labels: ['Mes (70%)', 'Semana (15%)', 'Día (0%)'],
        datasets: [{
          data: [70, 15, 0],
          backgroundColor: ['#06b6d4', '#ef4444', '#facc15']
        }]
      },
      options: {
        plugins: { legend: { labels: { color: 'white' } } }
      }
    });

    // Gráfico lineal
    new Chart(document.getElementById('lineChart'), {
      type: 'line',
      data: {
        labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
        datasets: [{
          label: 'Ingresos',
          data: [10, 15, 20, 30, 40, 50],
          borderColor: '#06b6d4',
          fill: false,
          tension: 0.3
        }]
      },
      options: {
        plugins: { legend: { labels: { color: 'white' } } },
        scales: {
          x: { ticks: { color: 'white' } },
          y: { ticks: { color: 'white' } }
        }
      }
    });
  </script>

</body>
</html>

