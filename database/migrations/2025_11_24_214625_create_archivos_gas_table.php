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
        Schema::create('archivos_gas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tramite')->nullable();
            $table->foreign('tramite')
            ->references('id')
            ->on('factura_gas');
            $table->string('archivo')->nullable();
            $table->timestamp('fecha')->nullable();
            $table->integer('tipo')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivos_gas');
    }
};
