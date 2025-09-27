<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->bigIncrements('id_estado');
            $table->string('descripcion', 100);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estados');
    }
};