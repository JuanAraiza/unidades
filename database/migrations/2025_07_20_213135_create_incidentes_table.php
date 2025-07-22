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
        Schema::create('incidentes', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_reg')->nullable();
            $table->unsignedBigInteger('unidad')->nullable();
            $table->foreign('unidad')
            ->references('id')
            ->on('unidad');
            $table->text('descripcion_c')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('importancia')->nullable();
            $table->string('imagen')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')
            ->references('id')
            ->on('users');
            $table->date('fecha_ven')->nullable();
            $table->string('odometro')->nullable();
            $table->integer('estatus')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidentes');
    }
};
