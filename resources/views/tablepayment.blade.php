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


  <aside class="w-60 bg-black p-4 flex flex-col">
    <h2 class="text-base font-bold mb-6">Dashboard</h2>
    <nav class="flex flex-col gap-2 text-xs">
      <a href="{{ route('dashboard') }}" class="hover:bg-gray-800 rounded-md px-3 py-2">🏠 Dashboard</a>
      <a href="{{ route('registercustomer') }}" class="hover:bg-gray-800 rounded-md px-3 py-2">👥 Registrar Cliente</a>
      <a href="{{ route('customers.index') }}" class="hover:bg-gray-800 rounded-md px-3 py-2">📋 Clientes</a>
      <a href="#" class="hover:bg-gray-800 rounded-md px-3 py-2">💳 Pagos</a>
      <a href="#" class="hover:bg-gray-800 rounded-md px-3 py-2">⚙️ Configuración</a>
    </nav>
  </aside>

 
  <main class="flex-1 flex items-start justify-center p-8 overflow-y-auto">
    <div class="bg-black bg-opacity-95 shadow-lg rounded-xl p-6 w-[1050px]">

     
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold">Historial de Pagos - {{ $customer->name }} {{ $customer->lastname }}</h1>
        <div class="flex gap-2">
          <button class="bg-green-700 px-3 py-1 rounded-md text-xs font-semibold">
            Total ({{ $payments->count() }})
          </button>
        </div>
      </div>

   
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
            </tr>
          </thead>
          <tbody class="bg-gray-800">
            @forelse($payments as $payment)
              <tr class="hover:bg-gray-700">
                <td class="px-4 py-2 border border-gray-700">{{ $payment->typeplan }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $payment->price }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $payment->datepay }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $payment->datestart }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $payment->datefinish }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $payment->estado }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center py-4 text-gray-400">No hay pagos registrados</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </main>
</body>
</html>
