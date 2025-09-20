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
    /* Transición para el mensaje */
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
      <a href="{{ route('registercustomer') }}" class="hover:bg-gray-800 rounded-md px-3 py-2">👥 Registrar Cliente</a>
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

  <!-- Main content -->
  <main class="flex-1 flex items-start justify-center p-8 overflow-y-auto">
    <div class="bg-black bg-opacity-95 shadow-lg rounded-xl p-6 w-[1050px]">

      <!-- Mensajes de confirmación / error -->
      @if(session('success'))
        <div id="flashMessage" class="mb-4 px-4 py-2 bg-green-600 text-white text-sm rounded-md shadow fade-transition" style="opacity:1; transform: translateY(0);">
          {{ session('success') }}
        </div>
      @endif

      @if ($errors->any())
        <div id="errorMessage" class="mb-4 px-4 py-2 bg-red-600 text-white text-sm rounded-md shadow fade-transition">
          <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Encabezado y buscador -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold">Gestión de Clientes</h1>
        <div class="flex gap-2 items-center">
          <form method="GET" action="{{ route('customers.index') }}" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
              placeholder="Buscar por cédula o nombre..."
              class="px-3 py-1 rounded-md text-black text-sm w-64">
            <button type="submit" class="bg-blue-600 px-3 py-1 rounded-md text-xs font-semibold hover:bg-blue-800">
              🔍 Buscar
            </button>
          </form>

          <button class="bg-green-700 px-3 py-1 rounded-md text-xs font-semibold">
            Total ({{ $customers->total() }})
          </button>
        </div>
      </div>

      <!-- Tabla -->
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
            @forelse($customers as $customer)
              <tr class="hover:bg-gray-700" data-id="{{ $customer->idcustomer }}">
                <td class="px-4 py-2 border border-gray-700 cedula">{{ $customer->cedula }}</td>
                <td class="px-4 py-2 border border-gray-700 name">{{ $customer->name }}</td>
                <td class="px-4 py-2 border border-gray-700 lastname">{{ $customer->lastname }}</td>
                <td class="px-4 py-2 border border-gray-700 phone">{{ $customer->phone }}</td>
                <td class="px-4 py-2 border border-gray-700 email">{{ $customer->email }}</td>

                <td class="px-4 py-2 border border-gray-700 flex gap-2">
                  <a href="{{ route('payments.history', $customer->idcustomer) }}" 
                     class="bg-blue-600 px-2 py-1 rounded text-xs hover:bg-blue-800">Historial</a>

                  <a href="javascript:void(0)" 
                     data-id="{{ $customer->idcustomer }}" 
                     class="editBtn bg-yellow-600 px-2 py-1 rounded text-xs hover:bg-yellow-800">
                    Editar
                  </a>

                  <form action="{{ route('customers.destroy', $customer->idcustomer) }}" method="POST" 
                        onsubmit="return confirm('¿Estás seguro de eliminar este cliente?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 px-2 py-1 rounded text-xs hover:bg-red-800">Eliminar</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center py-4 text-gray-400">No se encontraron clientes.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Paginación -->
      <div class="mt-4">
        {{ $customers->appends(['search' => request('search')])->links() }}
      </div>

      <!-- Modal de Edición -->
      <div id="editModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden">
        <div class="bg-gray-900 p-6 rounded-xl shadow-lg w-96">
          <h2 class="text-lg font-bold mb-4">Editar Cliente</h2>
          <form id="editForm" method="POST" onsubmit="return confirm('¿Deseas confirmar los cambios y actualizar este cliente?');">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label class="block text-sm">Nombre</label>
              <input type="text" name="name" id="editName" class="w-full px-3 py-2 rounded text-black">
            </div>

            <div class="mb-3">
              <label class="block text-sm">Apellidos</label>
              <input type="text" name="lastname" id="editLastname" class="w-full px-3 py-2 rounded text-black">
            </div>

            <div class="mb-3">
              <label class="block text-sm">Celular</label>
              <input type="text" name="phone" id="editPhone" class="w-full px-3 py-2 rounded text-black">
            </div>

            <div class="mb-3">
              <label class="block text-sm">Correo</label>
              <input type="email" name="email" id="editEmail" class="w-full px-3 py-2 rounded text-black">
            </div>

            <div class="flex justify-end gap-2 mt-4">
              <button type="button" id="closeModal" class="bg-gray-600 px-3 py-1 rounded">Cancelar</button>
              <button type="submit" class="bg-blue-600 px-3 py-1 rounded">Actualizar</button>
            </div>
          </form>
        </div>
      </div>
      <div class="flex justify-start gap-1 pt-4">
  <a href="{{ route('dashboard') }}" 
     class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2">
     ← Regresar
  </a>
</div>

    </div>
  </main>

  <!-- Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('editModal');
        const closeModal = document.getElementById('closeModal');
        const form = document.getElementById('editForm');

        // Abrir modal y cargar datos
        document.querySelectorAll('.editBtn').forEach(button => {
            button.addEventListener('click', async function () {
                let id = this.getAttribute('data-id');

                try {
                  // Traer datos del cliente (espera que /customers/{id}/edit devuelva JSON)
                  let response = await fetch(`/customers/${id}/edit`);
                  if (!response.ok) throw new Error('Error al obtener datos del cliente');
                  let data = await response.json();

                  // Rellenar campos
                  document.getElementById('editName').value = data.name ?? '';
                  document.getElementById('editLastname').value = data.lastname ?? '';
                  document.getElementById('editPhone').value = data.phone ?? '';
                  document.getElementById('editEmail').value = data.email ?? '';

                  // Actualizar action del formulario
                  form.action = `/customers/${id}`;

                  // Mostrar modal
                  modal.classList.remove('hidden');
                } catch (err) {
                  alert('No se pudieron cargar los datos del cliente. Intente de nuevo.');
                  console.error(err);
                }
            });
        });

        // Cerrar modal
        closeModal.addEventListener('click', function () {
            modal.classList.add('hidden');
        });

        // Si existe mensaje de sesión, lo mostramos y luego lo ocultamos suave
        const flash = document.getElementById('flashMessage');
        if (flash) {
          // Aseguramos que esté visible y luego la ocultamos después de 4s
          flash.style.opacity = '1';
          flash.style.transform = 'translateY(0)';
          setTimeout(() => {
            flash.style.transition = 'opacity .6s ease, transform .4s ease';
            flash.style.opacity = '0';
            flash.style.transform = 'translateY(-6px)';
            setTimeout(() => {
              if (flash.parentNode) flash.parentNode.removeChild(flash);
            }, 700);
          }, 4000);
        }

        // Si hay errores (validation), mantenerlos visibles  (puedes ajustar)
        const errors = document.getElementById('errorMessage');
        if (errors) {
          // No los auto-ocultamos automáticamente para que el usuario los vea
          errors.scrollIntoView({ behavior: 'smooth', block: 'center' });
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
  

  </script>
</body>
</html>