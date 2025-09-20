<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Customer;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function history($idcliente)
    {
        $customer = Customer::findOrFail($idcliente);
        $payments = Payment::where('idcliente', $idcliente)->get();

        return view('tablepayment', compact('customer', 'payments'));
    }

    public function store(Request $request, $idcliente)
    {
        // Validamos datos mínimos
        $request->validate([
            'typeplan'   => 'required|in:Día,Semana,Mes,Año',
            'datepay'    => 'required|date',
            'datestart'  => 'required|date',
            'datefinish' => 'required|date|after_or_equal:datestart',
        ]);

        // Precios fijos según el tipo de plan
        $prices = [
            'Día'    => 6000,
            'Semana' => 20000,
            'Mes'    => 40000,
            'Año'    => 450000,
        ];

        $price = $prices[$request->typeplan];

        // Crear el nuevo pago
        Payment::create([
            'idcliente'  => $idcliente,
            'typeplan'   => $request->typeplan,
            'price'      => $price,
            'datepay'    => $request->datepay,
            'datestart'  => $request->datestart,
            'datefinish' => $request->datefinish,
            'estado'     => 'Pagado',
        ]);

        return redirect()->route('payments.history', $idcliente)
                         ->with('success', '✅ El plan se ha agregado correctamente.');
    }

    public function destroy($idpay)
{
    $payment = Payment::findOrFail($idpay);
    $idcliente = $payment->idcliente; // para redirigir al historial correcto

    $payment->delete();

    return redirect()->route('payments.history', $idcliente)
                     ->with('success', '🗑️ Pago eliminado correctamente.');
}

}

