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
}
