<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('adopciones', function (Blueprint $table) {
        $table->id('id_adopcion');
        $table->unsignedBigInteger('id_mascota');
        $table->unsignedBigInteger('id_adoptante');
        $table->date('fecha_adopcion')->nullable();
        $table->text('observaciones')->nullable();
        $table->timestamps();
        $table->foreign('id_mascota')->references('id_mascota')->on('mascota')->onDelete('cascade');
        $table->foreign('id_adoptante')->references('id_adoptante')->on('adoptantes')->onDelete('cascade');
    });
}

    public function down()
    {
        Schema::dropIfExists('adopciones');
    }
};
