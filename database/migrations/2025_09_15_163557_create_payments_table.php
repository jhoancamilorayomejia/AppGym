<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id('idpay');
            $table->unsignedBigInteger('idcliente');
            $table->string('typeplan', 50);
            $table->decimal('price', 10, 2);
            $table->date('datepay');
            $table->date('datestart');
            $table->date('datefinish');
            $table->string('estado', 20)->default('Pagado');

            // FK hacia tabla customer
            $table->foreign('idcliente')->references('idcustomer')->on('customer')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
