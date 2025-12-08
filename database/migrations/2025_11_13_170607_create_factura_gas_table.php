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
        Schema::create('factura_gas', function (Blueprint $table) {
            $table->id();
            $table->string('factura')->nullable();
            $table->string('gasolinera')->nullable();
            $table->unsignedBigInteger('proveedor')->nullable();
            $table->foreign('proveedor')
            ->references('id')
            ->on('proveedor');
            $table->text('folios')->nullable();
            $table->text('otros')->nullable();
            $table->timestamp('fecha')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')
            ->references('id')
            ->on('users');
            $table->unsignedBigInteger('dependencia')->nullable();
            $table->foreign('dependencia')
            ->references('id')
            ->on('dependencia');
            $table->integer('oficio')->default(0);
            $table->string('tramite')->nullable();
            $table->string('combustible')->nullable();
            $table->integer('deshabilitado')->default(0);
            $table->integer('listo')->default(0);
            $table->integer('oculto')->default(0);
            $table->text('folios2')->nullable();

            $table->double('costo_t')->nullable();
            $table->text('folio')->nullable();
            $table->text('datos_g')->nullable();
            $table->text('nom_partida')->nullable();
            $table->integer('no_partida')->nullable();
            $table->double('presupuestado')->nullable();
            $table->double('ejercido')->nullable();
            $table->double('por_ejercer')->nullable();
            $table->double('importea_afectar')->nullable();
            $table->double('saldo_nuevo')->nullable();
            $table->text('folio_fiscal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_gas');
    }
};
