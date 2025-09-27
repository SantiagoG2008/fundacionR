<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('imagenes', function (Blueprint $table) {
            $table->id('id_imagen');
            $table->unsignedBigInteger('id_mascota');
            $table->string('nombre', 100);
            $table->string('ruta');
            $table->timestamps();
            $table->foreign('id_mascota')->references('id_mascota')->on('mascota')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imagenes');
    }
};
