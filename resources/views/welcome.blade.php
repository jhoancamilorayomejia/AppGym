<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen w-screen bg-cover bg-center flex items-center justify-center" 
      style="background-image: url('https://img.freepik.com/foto-gratis/vista-angulo-hombre-musculoso-irreconocible-preparandose-levantar-barra-club-salud_637285-2497.jpg?semt=ais_hybrid&w=740&q=80');">

 
  <div class="absolute inset-0 bg-black bg-opacity-70"></div>

 
  <div class="relative bg-black text-white shadow-2xl rounded-2xl p-6 w-80">
    <h2 class="text-xl font-bold text-center mb-6">Iniciar Sesión</h2>

   
    @if ($errors->any())
      <div class="mb-4 text-red-400 text-sm">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    
    <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
      @csrf

     
      <div>
        <label for="username" class="block text-sm font-medium">Usuario</label>
        <input id="username" name="username" type="text" required 
               class="w-full px-4 py-2 mt-1 border border-gray-600 rounded-lg bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-white"/>
      </div>

     
      <div>
        <label for="password" class="block text-sm font-medium">Contraseña</label>
        <input id="password" name="password" type="password" required 
               class="w-full px-4 py-2 mt-1 border border-gray-600 rounded-lg bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-white"/>
      </div>

     
      <div>
        <button type="submit" 
                class="w-full bg-white text-black py-2 rounded-lg font-semibold hover:bg-gray-200 transition">
          Iniciar
        </button>
      </div>
    </form>
  </div>

</body>
</html>

