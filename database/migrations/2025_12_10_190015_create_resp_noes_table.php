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
        Schema::create('resp_noes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('responsable');
            $table->foreign('responsable')
            ->references('id')
            ->on('responsable');
            $table->string('no_economico')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resp_noes');
    }
};
