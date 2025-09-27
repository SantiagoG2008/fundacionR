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
    Schema::create('donaciones', function (Blueprint $table) {
        $table->id('id_donacion');
        $table->string('tipo');
        $table->decimal('cantidad', 10, 2)->nullable();
        $table->date('fecha');
        $table->unsignedBigInteger('id_adoptante');
        $table->timestamps();
        $table->foreign('id_adoptante')->references('id_adoptante')->on('adoptantes')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donaciones');
    }
};
