<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('panel_config', function (Blueprint $table) {
            $table->id('id_config');
            $table->string('clave', 50)->unique();
            $table->boolean('valor')->default(false);
            $table->timestamps();
        });

        DB::table('panel_config')->insert([
            'clave' => 'panel_activo',
            'valor' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('panel_config');
    }
};
