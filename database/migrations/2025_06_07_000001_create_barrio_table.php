<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barrio', function (Blueprint $table) {
    $table->id('id_barrio');
    $table->string('nombre_barrio', 100);
    $table->unsignedBigInteger('id_localidad');
    $table->timestamps();
    $table->foreign('id_localidad')->references('id_localidad')->on('localidad_usu')->onDelete('cascade');
    });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barrio');
    }
};
