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
        Schema::create('operador', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('paterno')->nullable();
            $table->string('materno')->nullable();
            $table->string('puesto')->nullable();
            $table->unsignedBigInteger('area')->nullable();
            $table->foreign('area')
            ->references('id')
            ->on('area');
            $table->unsignedBigInteger('dependencia')->nullable();
            $table->foreign('dependencia')
            ->references('id')
            ->on('dependencia');
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('licencia')->nullable();
            $table->date('vigencia')->nullable();
            $table->string('foto')->nullable();
            $table->integer('deshabilitado')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operador');
    }
};
