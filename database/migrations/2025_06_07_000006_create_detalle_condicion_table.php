<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detalle_condicion', function (Blueprint $table) {
            $table->bigIncrements('id_condicion');
            $table->string('descripcion', 150);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_condicion');
    }
};