<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historial de Pagos</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Flatpickr (Calendario) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>

  <style>
    body {
      background: url('https://img.freepik.com/foto-gratis/vista-angulo-hombre-musculoso-irreconocible-preparandose-levantar-barra-club-salud_637285-2497.jpg?semt=ais_hybrid&w=740&q=80') no-repeat center center fixed;
      background-size: cover;
    }
    

    /* Personalización del rango en naranja */
    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange,
    .flatpickr-day.inRange {
      background: orange !important;
      border-color: orange !important;
      color: black !important;
    }
  </style>
</head>
<body class="h-screen flex text-white">

  <!-- Sidebar -->
  <aside class="w-60 bg-black p-4 flex flex-col">
    <h2 class="text-base font-bold mb-6">Panel de Control</h2>
    <nav class="flex flex-col gap-2 text-xs">
      <!-- Clientes -->
      <a href="{{ route('planes.index', ['iduser' => session('user')->iduser]) }}" class="hover:bg-gray-800 rounded-md px-3 py-2">📅 Historial de Pagos</a>

      <!-- Configuración -->
      <div class="relative mt-2">
        <button id="configButton" 
                class="w-full text-left hover:bg-gray-800 rounded-md px-3 py-2 flex items-center justify-between">
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

  <!-- Contenido principal -->
  <main class="flex-1 flex items-start justify-center p-8 overflow-y-auto">
    <div class="bg-black bg-opacity-95 shadow-lg rounded-xl p-6 w-[1050px]">

      <!-- Encabezado -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold">
          Historial de Pagos - {{ $usuario->name }} {{ $usuario->lastname }}
        </h1>
        <div>
          <span class="bg-green-700 px-3 py-1 rounded-md text-xs font-semibold">
            Total ({{ $payments->count() }})
          </span>
        </div>
      </div>

      <!-- Tabla de pagos -->
      <div class="overflow-x-auto">
        <table class="w-full text-sm border border-gray-700 rounded-lg">
          <thead class="bg-gray-900">
            <tr>
              <th class="px-4 py-2 border border-gray-700">Tipo Plan</th>
              <th class="px-4 py-2 border border-gray-700">Precio</th>
              <th class="px-4 py-2 border border-gray-700">Fecha Pago</th>
              <th class="px-4 py-2 border border-gray-700">Inicio</th>
              <th class="px-4 py-2 border border-gray-700">Fin</th>
              <th class="px-4 py-2 border border-gray-700">Estado</th>
              <th class="px-4 py-2 border border-gray-700">Vista Calendario</th>
            </tr>
          </thead>
          <tbody class="bg-gray-800">
            @forelse($payments as $payment)
              <tr class="hover:bg-gray-700">
                <td class="px-4 py-2 border border-gray-700">{{ $payment->typeplan }}</td>
                <td class="px-4 py-2 border border-gray-700 text-green-500 font-semibold">{{ $payment->price }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $payment->datepay }}</td>
                <td class="px-4 py-2 border border-gray-700 text-blue-400 font-medium">{{ $payment->datestart }}</td>
                <td class="px-4 py-2 border border-gray-700 text-red-400 font-medium">{{ $payment->datefinish }}</td>
                <td class="px-4 py-2 border border-gray-700 text-green-500 font-bold">{{ $payment->estado }}</td>
                <td class="px-4 py-2 border border-gray-700 text-center">
                  <button 
                    class="bg-blue-600 hover:bg-blue-800 px-3 py-1 rounded-md text-xs"
                    onclick="showCalendar('{{ $payment->datestart }}','{{ $payment->datefinish }}')">
                    📅 Ver
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center py-4 text-gray-400">No hay pagos registrados</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="flex justify-start gap-1 pt-4">
        <a href="{{ route('dashboarduser') }}" 
          class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2">
          ← Regresar al Menú
        </a>
      </div>
    </div>
  </main>

  

  <!-- Modal Calendario -->
  <div id="calendarModal" class="fixed inset-0 bg-black bg-opacity-70 hidden flex items-center justify-center z-50">
    <div class="bg-black bg-opacity-70 p-6 rounded-lg shadow-lg w-[400px]">
      <h2 class="text-lg font-bold mb-4">Vista Calendario</h2>
      <div id="calendarPicker"></div>
      <div class="flex justify-end mt-4">
        <button onclick="closeCalendar()" class="bg-red-600 hover:bg-red-800 px-4 py-2 rounded-md">Cerrar</button>
      </div>
    </div>
  </div>

  <!-- Script -->
  <script>
    let calendarInstance = null;

    function showCalendar(start, end) {
      document.getElementById("calendarModal").classList.remove("hidden");

      if (calendarInstance) {
        calendarInstance.destroy(); // destruir instancia previa
      }

      calendarInstance = flatpickr("#calendarPicker", {
        inline: true,
        locale: "es",
        mode: "range",
        defaultDate: [start, end],
      });
    }

    function closeCalendar() {
      document.getElementById("calendarModal").classList.add("hidden");
    }

    // Menú configuración
    const configButton = document.getElementById("configButton");
    const configMenu = document.getElementById("configMenu");
    configButton.addEventListener("click", () => {
      configMenu.classList.toggle("hidden");
    });
    document.addEventListener("click", (e) => {
      if (!configButton.contains(e.target) && !configMenu.contains(e.target)) {
        configMenu.classList.add("hidden");
      }
    });
  </script>
</body>
</html>
