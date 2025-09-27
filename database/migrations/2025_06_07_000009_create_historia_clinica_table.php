<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('historia_clinica', function (Blueprint $table) {
        $table->id('id_historia');
        $table->unsignedBigInteger('id_mascota');
        $table->date('fecha_chequeo');
        $table->float('peso');
        $table->text('tratamiento');
        $table->text('observaciones')->nullable();
        $table->text('cuidados')->nullable();
        $table->timestamps();
        $table->foreign('id_mascota')->references('id_mascota')->on('mascota')->onDelete('cascade');
    });
}

    public function down(): void {
        Schema::dropIfExists('historia_clinicas');
    }
};