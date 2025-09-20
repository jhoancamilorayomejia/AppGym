<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UsuarioController;

// Rutas públicas
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Rutas protegidas (solo accesibles si hay login)
Route::middleware(['auth.custom'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Registrar Cliente
    Route::get('/registercustomer', fn() => view('registercustomer'))->name('registercustomer');

    // CRUD de clientes
    Route::resource('customers', CustomerController::class);
    Route::get('/customers/{id}/history', [CustomerController::class, 'history'])->name('customers.history');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');

    // Pagos
    Route::get('/payments/history/{idcliente}', [PaymentController::class, 'history'])->name('payments.history');
    Route::post('/payments/store/{idcliente}', [PaymentController::class, 'store'])->name('payments.store');
    
    // Actualizar datos de clientes
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');

    // Eliminar pago
    Route::delete('/payments/{idpay}', [PaymentController::class, 'destroy'])->name('payments.destroy');

    // Formulario de crear administrador
    Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');

    // Guardar administrador
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');

    

    Route::resource('usuarios', UsuarioController::class);

   
    //mostrar usuarios
    Route::resource('usuarios', UsuarioController::class);




    // Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
