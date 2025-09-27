<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('presentacion');
    }

    public function down()
    {
        Schema::create('presentacion', function (Blueprint $table) {
            $table->id('id_presentac');
            $table->string('descripcion', 100);
            $table->timestamps();
        });
    }
};
