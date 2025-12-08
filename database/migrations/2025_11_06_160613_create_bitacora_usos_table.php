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
        Schema::create('bitacora_usos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unidad')->nullable();
            $table->foreign('unidad')
            ->references('id')
            ->on('unidad');
            $table->date('fecha_reg')->nullable();
            $table->string('actividad')->nullable();
            $table->string('evidencia1')->nullable();
            $table->string('evidencia2')->nullable();
            $table->string('evidencia3')->nullable();
            $table->timestamp('fecha')->nullable();
            $table->unsignedBigInteger('operador')->nullable();
            $table->foreign('operador')
            ->references('id')
            ->on('operador');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')
            ->references('id')
            ->on('users');
            $table->string('destino')->nullable();
            $table->string('km')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacora_usos');
    }
};
