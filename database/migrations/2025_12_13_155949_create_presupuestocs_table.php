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
        Schema::create('presupuestocs', function (Blueprint $table) {
            $table->id();
            $table->string('ejercicio')->nullable();
            $table->string('fondo')->nullable();
            $table->string('programa')->nullable();
            $table->string('centro_g')->nullable();
            $table->string('nombre_cg')->nullable();
            $table->string('area_fun')->nullable();
            $table->string('partida')->nullable();
            $table->string('partida_den')->nullable();
            $table->float('asignado')->nullable();
            $table->float('disponible')->nullable();
            $table->float('comprometido')->nullable();
            $table->float('formalizado')->nullable();
            $table->float('tramite')->nullable();
            $table->unsignedBigInteger('dependencia')->nullable();
            $table->foreign('dependencia')
            ->references('id')
            ->on('dependencia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presupuestocs');
    }
};
