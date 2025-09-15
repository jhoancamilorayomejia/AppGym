<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Clientes</title>
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
        <h1 class="text-xl font-bold">Gestión de Clientes</h1>
        <div class="flex gap-2">
          <button class="bg-green-700 px-3 py-1 rounded-md text-xs font-semibold">
            Total ({{ $customers->count() }})
          </button>
        </div>
      </div>

      
      <div class="overflow-x-auto">
        <table class="w-full text-sm border border-gray-700 rounded-lg">
          <thead class="bg-gray-900">
            <tr>
              <th class="px-4 py-2 border border-gray-700">Cédula</th>
              <th class="px-4 py-2 border border-gray-700">Nombre</th>
              <th class="px-4 py-2 border border-gray-700">Apellidos</th>
              <th class="px-4 py-2 border border-gray-700">Celular</th>
              <th class="px-4 py-2 border border-gray-700">Correo</th>
              <th class="px-4 py-2 border border-gray-700">Acciones</th>
            </tr>
          </thead>
          <tbody class="bg-gray-800">
            @foreach($customers as $customer)
              <tr class="hover:bg-gray-700">
                <td class="px-4 py-2 border border-gray-700">{{ $customer->cedula }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $customer->name }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $customer->lastname }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $customer->phone }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $customer->email }}</td>


                <td class="px-4 py-2 border border-gray-700 flex gap-2">
                  <a href="{{ route('payments.history', $customer->idcustomer) }}" class="bg-blue-600 px-2 py-1 rounded text-xs hover:bg-blue-800">Historial</a>
                  <a href="{{ route('customers.edit', $customer->idcustomer) }}" class="bg-yellow-600 px-2 py-1 rounded text-xs hover:bg-yellow-800">Editar</a>
                  <form action="{{ route('customers.destroy', $customer->idcustomer) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 px-2 py-1 rounded text-xs hover:bg-red-800">Eliminar</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      
      <div class="flex justify-between items-center mt-4">
        <div class="flex gap-2">
          <button class="px-3 py-1 bg-gray-700 rounded">Prev</button>
          <button class="px-3 py-1 bg-blue-600 rounded">1</button>
          <button class="px-3 py-1 bg-gray-700 rounded">2</button>
          <button class="px-3 py-1 bg-gray-700 rounded">3</button>
          <button class="px-3 py-1 bg-gray-700 rounded">Next</button>
        </div>
      </div>

    </div>
  </main>
</body>
</html>

