<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request; 

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
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
}
