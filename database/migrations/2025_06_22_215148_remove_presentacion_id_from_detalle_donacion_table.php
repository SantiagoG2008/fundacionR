<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('detalle_donacion', function (Blueprint $table) {
            if (Schema::hasColumn('detalle_donacion', 'presentacion_id')) {
                // Elimina la clave foránea si existe
                try {
                    $table->dropForeign(['presentacion_id']);
                } catch (\Throwable $e) {
                    // Si ya fue eliminada manualmente, no pasa nada
                }

                // Elimina el campo
                $table->dropColumn('presentacion_id');
            }
        });
    }

    public function down()
    {
        Schema::table('detalle_donacion', function (Blueprint $table) {
            $table->unsignedBigInteger('presentacion_id')->nullable();
            // Si quieres, puedes volver a crear la FK aquí
            // $table->foreign('presentacion_id')->references('id_presentac')->on('presentacion')->onDelete('restrict');
        });
    }
};
