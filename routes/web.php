<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;


// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Registrar Cliente
Route::get('/registercustomer', function () {
    return view('registercustomer');
})->name('registercustomer');

// Rutas CRUD de clientes table
Route::resource('customers', CustomerController::class);

// Ruta adicional para historial
Route::get('/customers/{id}/history', [CustomerController::class, 'history'])->name('customers.history');

//insert
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');

//historial de pagos
Route::get('/payments/history/{idcliente}', [PaymentController::class, 'history'])->name('payments.history');




// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
