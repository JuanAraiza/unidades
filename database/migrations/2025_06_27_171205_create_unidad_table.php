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
        Schema::create('unidad', function (Blueprint $table) {
            $table->id();
            $table->string('tunidad')->nullable();
            $table->string('modelo')->nullable();
            $table->string('marca')->nullable();
            $table->string('anio')->nullable();
            $table->string('color')->nullable();
            $table->string('imagen')->nullable();
            $table->string('placas')->nullable();
            $table->string('no_economico')->nullable();
            $table->string('combustible')->nullable();
            $table->unsignedBigInteger('tipov')->nullable();
            $table->foreign('tipov')
            ->references('id')
            ->on('tvehiculo');
            $table->string('estatus')->nullable();
            $table->string('inicio_est')->nullable();
            $table->string('medida_usu')->nullable();
            $table->string('medida_con')->nullable();
            $table->unsignedBigInteger('area')->nullable();
            $table->foreign('area')
            ->references('id')
            ->on('area');
            $table->unsignedBigInteger('responsable')->nullable();
            $table->foreign('responsable')
            ->references('id')
            ->on('responsable');
            $table->string('no_serie')->nullable();
            $table->string('cilindros')->nullable();
            $table->string('factura')->nullable();
            $table->string('uso')->nullable();
            $table->longText('detalles')->nullable();
            $table->string('clave');
            $table->unsignedBigInteger('user')->nullable();
            $table->foreign('user')
            ->references('id')
            ->on('users');
            $table->integer('deshabilitado')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidad');
    }
};
