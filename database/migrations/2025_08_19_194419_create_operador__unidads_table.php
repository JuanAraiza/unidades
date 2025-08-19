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
        Schema::create('operador__unidads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unidad')->nullable();
            $table->foreign('unidad')
            ->references('id')
            ->on('unidad');
            $table->unsignedBigInteger('operador')->nullable();
            $table->foreign('operador')
            ->references('id')
            ->on('operador');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operador__unidads');
    }
};
