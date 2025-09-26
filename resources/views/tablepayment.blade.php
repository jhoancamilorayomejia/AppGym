<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historial de Pagos</title>
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
              <th class="px-4 py-2 border border-gray-700">Acciones</th>
            </tr>
          </thead>
          <tbody class="bg-gray-800">
            @forelse($payments as $payment)
              <tr class="hover:bg-gray-700">
                <td class="px-4 py-2 border border-gray-700">{{ $payment->typeplan }}</td>
                <td class="px-4 py-2 border border-gray-700 text-green-500 font-semibold">
                  {{ $payment->price }}
                </td>
                <td class="px-4 py-2 border border-gray-700">{{ $payment->datepay }}</td>
                <td class="px-4 py-2 border border-gray-700 text-blue-400 font-medium">
                  {{ $payment->datestart }}
                </td>
                <td class="px-4 py-2 border border-gray-700 text-red-400 font-medium">
                  {{ $payment->datefinish }}
                </td>
                <td class="px-4 py-2 border border-gray-700 text-green-500 font-bold">
                  {{ $payment->estado }}
                </td>
                <td class="px-4 py-2 border border-gray-700 text-center">
                  <form action="{{ route('payments.destroy', ['idpay' => $payment->idpay]) }}"
                        method="POST"
                        class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                      class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md text-xs font-semibold"
                      onclick="return confirm('⚠️ ¿Estás seguro de eliminar este pago?');">
                      🗑 Eliminar
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center py-4 text-gray-400">
                  No hay pagos registrados
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Formulario para agregar plan -->
      <div class="bg-gray-900 p-4 rounded-lg shadow-md mt-6">
        <h2 class="text-lg font-semibold mb-4">➕ Agregar Nuevo Plan</h2>

        <form id="paymentForm" method="POST" action="{{ route('payments.store', $usuario->iduser) }}" class="flex flex-col gap-4">
          @csrf
          <div class="grid grid-cols-4 gap-4">
            <!-- Tipo de plan -->
            <div class="flex flex-col">
              <label for="typeplan" class="text-sm font-medium mb-1">Tipo de Plan</label>
              <select id="typeplan" name="typeplan" class="bg-gray-800 border border-gray-700 rounded-md px-3 py-2 text-sm">
                <option value="Día" data-price="6000">Día - $6.000</option>
                <option value="Semana" data-price="20000">Semana - $20.000</option>
                <option value="Mes" data-price="40000">Mes - $40.000</option>
                <option value="Año" data-price="450000">Año - $450.000</option>
              </select>
            </div>

            <!-- Fecha de pago -->
            <div class="flex flex-col">
              <label for="datepay" class="text-sm font-medium mb-1">Fecha de Pago</label>
              <input id="datepay" type="date" name="datepay"
                     value="{{ old('datepay', date('Y-m-d')) }}"
                     class="bg-gray-800 border border-gray-700 rounded-md px-3 py-2 text-sm">
            </div>

            <!-- Inicio -->
            <div class="flex flex-col">
              <label for="datestart" class="text-sm font-medium mb-1">Inicio del Plan</label>
              <input id="datestart" type="date" name="datestart"
                     value="{{ old('datestart') }}"
                     class="bg-gray-800 border border-gray-700 rounded-md px-3 py-2 text-sm">
            </div>

            <!-- Fin -->
            <div class="flex flex-col">
              <label for="datefinish" class="text-sm font-medium mb-1">Fin del Plan</label>
              <input id="datefinish" type="date" name="datefinish"
                     value="{{ old('datefinish') }}"
                     class="bg-gray-800 border border-gray-700 rounded-md px-3 py-2 text-sm">
            </div>
          </div>

          <!-- Botón -->
          <div class="flex justify-end">
            <button type="submit" class="bg-green-600 hover:bg-green-700 px-5 py-2 rounded-md font-semibold">
              Guardar Plan
            </button>
          </div>
        </form>
      </div>
      <div class="flex justify-start gap-1 pt-4">
  <a href="javascript:history.back()" 
     class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2">
     ← Regresar al Menú
  </a>
</div>


    </div>
  </main>

  <!-- Script de confirmación -->
  <script>
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const typeplan = document.getElementById('typeplan');
      const selectedOption = typeplan.options[typeplan.selectedIndex];
      const planName = selectedOption.value;
      const price = selectedOption.getAttribute('data-price');
      const datestart = document.getElementById('datestart').value;
      const datefinish = document.getElementById('datefinish').value;

      const confirmMessage =
        `⚠️ ¿Confirmas guardar este plan?\n\n` +
        `📌 Tipo de plan: ${planName}\n` +
        `💲 Precio: $${price}\n` +
        `📅 Inicio: ${datestart}\n` +
        `📅 Fin: ${datefinish}`;

      if (confirm(confirmMessage)) {
        this.submit();
      }
    });

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
