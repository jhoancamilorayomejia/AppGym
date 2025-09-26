<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Mostrar historial de pagos de un usuario (iduser)
    public function history($iduser)
{
    $usuario = Usuario::findOrFail($iduser);

    // Ordenamos por fecha de inicio DESC (más reciente primero)
    $payments = Payment::where('iduser', $iduser)
        ->orderBy('datestart', 'desc')
        ->get();

    return view('tablepayment', compact('usuario', 'payments'));
}


    // Guardar pago (store) para el usuario $iduser
    public function store(Request $request, $iduser)
    {
        // Validación (mensajes en español automáticos por Laravel si están configurados)
        $request->validate([
            'typeplan'   => 'required|in:Día,Semana,Mes,Año',
            'datepay'    => 'required|date',
            'datestart'  => 'required|date',
            'datefinish' => 'required|date|after_or_equal:datestart',
        ]);

        // Precios fijos según el tipo de plan (asegúrate que los valores coincidan con el <select>)
        $prices = [
            'Día'    => 6000,
            'Semana' => 20000,
            'Mes'    => 40000,
            'Año'    => 450000,
        ];

        // Asegurarnos de que el tipo de plan existe en el arreglo (por seguridad)
        $typeplan = $request->typeplan;
        if (!array_key_exists($typeplan, $prices)) {
            return redirect()->back()->withErrors(['typeplan' => 'Tipo de plan inválido'])->withInput();
        }

        // --- AQUÍ definimos $price correctamente ---
        $price = $prices[$typeplan];

        // Crear el nuevo pago
        Payment::create([
            'iduser'     => $iduser,
            'typeplan'   => $typeplan,
            'price'      => $price,
            'datepay'    => $request->datepay,
            'datestart'  => $request->datestart,
            'datefinish' => $request->datefinish,
            'estado'     => 'Pagado',
        ]);

        return redirect()->route('payments.history', $iduser)
                         ->with('success', '✅ El plan se ha agregado correctamente.');
    }

    // Eliminar pago
    public function destroy($idpay)
    {
        $payment = Payment::findOrFail($idpay);
        $iduser = $payment->iduser;

        $payment->delete();

        return redirect()->route('payments.history', $iduser)
                         ->with('success', '🗑️ Pago eliminado correctamente.');
    }
   

  public function historyuser($iduser)
{
    $usuario = \App\Models\Usuario::findOrFail($iduser);

    $payments = \App\Models\Payment::where('iduser', $iduser)
        ->orderBy('datestart', 'desc') // 👈 Ordenamos por la fecha más reciente
        ->get()
        ->map(function ($p) {
            // Formateamos las fechas al formato que entiende el input type="date"
            $p->datestart  = \Carbon\Carbon::parse($p->datestart)->format('Y-m-d');
            $p->datefinish = \Carbon\Carbon::parse($p->datefinish)->format('Y-m-d');
            $p->datepay    = \Carbon\Carbon::parse($p->datepay)->format('Y-m-d'); // opcional
            return $p;
        });

    return view('planes', compact('usuario', 'payments'));
}


    

   
}
