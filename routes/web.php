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

    // Dashboard para administradores
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Dashboard para clientes
    Route::get('/dashboarduser', fn() => view('dashboarduser'))->name('dashboarduser');

    // Registrar Cliente
    Route::get('/registercustomer', fn() => view('registercustomer'))->name('registercustomer');

    // CRUD de clientes
    Route::resource('customers', UsuarioController::class)->except(['show']);
    Route::get('/customers/{id}/history', [UsuarioController::class, 'history'])->name('customers.history');

    
    // Pagos
    Route::get('/payments/history/{iduser}', [PaymentController::class, 'history'])->name('payments.history');
    Route::post('/payments/store/{iduser}', [PaymentController::class, 'store'])->name('payments.store');
    
    //lista de pagos de cliente
   Route::get('/planes/{iduser}', [PaymentController::class, 'historyuser'])->name('planes.index');
    
    // Actualizar datos de clientes
    Route::get('/customers/{id}/edit', [UsuarioController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{id}', [UsuarioController::class, 'update'])->name('customers.update');

    // Eliminar pago
    Route::delete('/payments/{idpay}', [PaymentController::class, 'destroy'])->name('payments.destroy');

    // CRUD de usuarios (excluyendo show)
    Route::resource('usuarios', UsuarioController::class)->except(['show']);

    // Vista específica para administradores
    Route::get('/usuarios/admins', [UsuarioController::class, 'indexAdmin'])->name('usuarios.admins');

    // Eliminar admin
    Route::delete('/usuarios/admins/{id}', [UsuarioController::class, 'destroyAdmin'])->name('usuarios.destroyAdmin');

    // Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
