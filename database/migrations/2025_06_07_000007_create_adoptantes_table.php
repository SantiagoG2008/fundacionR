<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adoptantes', function (Blueprint $table) {

            /* ───── PRIMARY KEY ───── */
            $table->bigIncrements('id_adoptante');

            /* ───── DATOS BÁSICOS ───── */
            $table->string('nombres');
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('edad')->nullable();

            /* ───── DOCUMENTO ───── */
            $table->string('nro_docum')->unique();      // número
            $table->unsignedBigInteger('id_tipo');      // FK → tipo_docum.id_tipo

            /* ───── OTROS DATOS ───── */
            $table->string('correo')->nullable();
            $table->enum('sexo', ['M', 'F', 'O'])->nullable();

            /* ───── UBICACIÓN ───── */
            $table->unsignedBigInteger('id_localidad'); // FK → localidad_usu.id_localidad
            $table->unsignedBigInteger('id_barrio');    // FK → barrio.id_barrio

            $table->string('rol')->default('usuario');

            $table->timestamps();

            /* ───── FOREIGN KEYS ───── */
            $table->foreign('id_tipo')
                  ->references('id_tipo')
                  ->on('tipo_docum')
                  ->onDelete('restrict');

            $table->foreign('id_localidad')
                  ->references('id_localidad')
                  ->on('localidad_usu')
                  ->onDelete('cascade');

            $table->foreign('id_barrio')
                  ->references('id_barrio')
                  ->on('barrio')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoptantes');
    }
};
