<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mascota', function (Blueprint $table) {
            $table->bigIncrements('id_mascota');
            $table->string('nombre_mascota', 50);
            $table->integer('edad')->nullable();
            $table->boolean('vacunado')->default(false);
            $table->boolean('peligroso')->default(false);
            $table->boolean('esterilizado')->default(false);
            $table->boolean('destetado')->default(false);
            $table->string('genero', 10)->nullable();
            $table->text('imagen')->nullable();
            $table->boolean('crianza')->default(false);
            $table->date('fecha_ingreso')->nullable();
            $table->boolean('condiciones_especiales')->default(false);
            $table->unsignedBigInteger('raza_id')->nullable();
            $table->unsignedBigInteger('condicion_id')->nullable();
            $table->unsignedBigInteger('estado_id')->nullable();
            $table->foreign('raza_id')->references('id_raza')->on('razas')->onDelete('set null');
            $table->foreign('condicion_id')->references('id_condicion')->on('detalle_condicion')->onDelete('set null');
            $table->foreign('estado_id')->references('id_estado')->on('estados')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mascota');
    }
};