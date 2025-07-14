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
        Schema::create('pregcio_gas', function (Blueprint $table) {
            $table->id();
            $table->double('gas1', 8, 2)->default(0);
            $table->double('gas2', 8, 2)->default(0);
            $table->double('diesel', 8, 2)->default(0);
            $table->double('lp', 8, 2)->default(0);
            $table->date('fecha');
            $table->time('hora');
            $table->unsignedBigInteger('proveedor')->nullable();
            $table->foreign('proveedor')
                ->references('id')
                ->on('proveedor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pregcio_gas');
    }
};
