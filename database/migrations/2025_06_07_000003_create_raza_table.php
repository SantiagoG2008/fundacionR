<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('razas', function (Blueprint $table) {
            $table->bigIncrements('id_raza');
            $table->string('nombre_raza', 100)->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('razas');
    }
};