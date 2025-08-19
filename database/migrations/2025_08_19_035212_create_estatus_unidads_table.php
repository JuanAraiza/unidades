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
        Schema::create('estatus_unidads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unidad')->nullable();
            $table->foreign('unidad')
            ->references('id')
            ->on('unidad');
            $table->date('f_registro')->nullable();
            $table->string('periodo')->nullable();
            $table->string('estatus')->nullable();
            $table->string('motivo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estatus_unidads');
    }
};
