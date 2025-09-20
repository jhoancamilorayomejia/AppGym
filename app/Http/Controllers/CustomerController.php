<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request; 

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        // Si hay búsqueda, filtramos por cédula o nombre
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('cedula', 'LIKE', "%{$search}%")
                  ->orWhere('name', 'LIKE', "%{$search}%");
        }

        // Paginación para no cargar todos los clientes de una sola
        $customers = $query->paginate(10);

        return view('tablecustomer', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cedula' => 'required|unique:customer,cedula',
            'name' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:customer,email',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')->with('success', 'Cliente registrado correctamente.');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Cliente eliminado correctamente.');
    }

    public function edit($id)
{
    $customer = Customer::findOrFail($id);
    return response()->json($customer); // lo devolvemos en JSON para el modal
}

public function update(Request $request, $id)
{
    $customer = Customer::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:100',
        'lastname' => 'required|string|max:100',
        'phone' => 'required|string|max:20',
        'email' => 'required|email|unique:customer,email,' . $customer->idcustomer . ',idcustomer',
    ]);

    $customer->update($request->only(['name', 'lastname', 'phone', 'email']));

    return redirect()->route('customers.index')
        ->with('success', '✅ Cliente actualizado correctamente.');
}

}


