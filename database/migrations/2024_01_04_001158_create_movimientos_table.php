<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->string('detalle');
            // $table->uuid('id_billetera_entrada');
            // $table->uuid('id_billetera_salida');
            $table->uuid('id_billetera');
            $table->float('monto');
            $table->unsignedBigInteger('id_transaccion');
            // $table->foreign('id_billetera_entrada')->references('id')->on('billeteras');
            // $table->foreign('id_billetera_salida')->references('id')->on('billeteras');
            $table->foreign('id_billetera')->references('id')->on('billeteras');
            $table->foreign('id_transaccion')->references('id')->on('transacciones');
            $table->boolean('deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
