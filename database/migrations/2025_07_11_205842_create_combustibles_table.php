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
        Schema::create('combustibles', function (Blueprint $table) {
            $table->id();
            $table->string('folio')->nullable();
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->unsignedBigInteger('unidad')->nullable();
            $table->foreign('unidad')
            ->references('id')
            ->on('unidad');
            $table->integer('km')->nullable();
            $table->string('justificacion')->nullable();
            $table->unsignedBigInteger('operador')->nullable();
            $table->foreign('operador')
            ->references('id')
            ->on('operador');
            $table->string('destino')->nullable();
            $table->string('tipo_com')->nullable();
            $table->string('litros')->nullable();
            $table->decimal('costo')->nullable();
            $table->unsignedBigInteger('area')->nullable();
            $table->foreign('area')
            ->references('id')
            ->on('area');
            $table->unsignedBigInteger('dependencia');
            $table->foreign('dependencia')
            ->references('id')
            ->on('dependencia');
            $table->unsignedBigInteger('proveedor')->nullable();
            $table->foreign('proveedor')
            ->references('id')
            ->on('proveedor');
            $table->integer('validado')->default(0);
            $table->integer('estatus')->default(1);
            $table->text('mensaje_c')->nullable();
            $table->integer('deshabilitado')->default(0);
            
            $table->date('fecha_c')->nullable();
            $table->date('fecha_p')->nullable();
            $table->integer('vigencia')->nulleable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combustibles');
    }
};
