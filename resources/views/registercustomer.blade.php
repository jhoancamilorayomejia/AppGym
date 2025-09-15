<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Cliente</title>
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
      <a href="dashboard.html" class="hover:bg-gray-800 rounded-md px-3 py-2">🏠 Dashboard</a>
      <a href="#" class="hover:bg-gray-800 rounded-md px-3 py-2">👥 Clientes</a>
      <a href="#" class="hover:bg-gray-800 rounded-md px-3 py-2">💳 Pagos</a>
      <a href="#" class="hover:bg-gray-800 rounded-md px-3 py-2">⚙️ Configuración</a>
    </nav>
  </aside>

  
  <main class="flex-1 flex items-start justify-center p-8 overflow-y-auto">

   
    <div class="bg-black bg-opacity-95 shadow-lg rounded-xl p-6 w-[600px]">

     
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold">Registrar Cliente Nuevo</h1>
        <a href="dashboard" class="text-sm text-blue-400 hover:underline">⬅ Volver</a>
      </div>

     
      <form action="{{ route('customers.store') }}" method="POST" class="space-y-4">
  @csrf
  <div>
    <label class="block text-sm mb-1">Cédula</label>
    <input type="text" name="cedula" required
           class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700">
  </div>

  <div>
    <label class="block text-sm mb-1">Nombres</label>
    <input type="text" name="name" required
           class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700">
  </div>

  <div>
    <label class="block text-sm mb-1">Apellidos</label>
    <input type="text" name="lastname" required
           class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700">
  </div>

  <div>
    <label class="block text-sm mb-1">Celular</label>
    <input type="tel" name="phone" required
           class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700">
  </div>

  <div>
    <label class="block text-sm mb-1">Correo</label>
    <input type="email" name="email" required
           class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700">
  </div>


  <div class="flex justify-end gap-3 pt-4">
    <a href="{{ route('dashboard') }}" 
       class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded-lg text-sm font-semibold">
       Cancelar
    </a>
    <button type="submit" 
            class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg text-sm font-semibold">
      Guardar Cliente
    </button>
  </div>
</form>


    </div>
  </main>
</body>
</html>
