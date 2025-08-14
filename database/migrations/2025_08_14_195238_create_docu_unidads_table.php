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
        Schema::create('docu_unidads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unidad')->nullable();
            $table->foreign('unidad')
            ->references('id')
            ->on('unidad');
            $table->string('documento')->nullable();
            $table->string('titulo')->nullable();
            $table->date('vencimiento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docu_unidads');
    }
};
