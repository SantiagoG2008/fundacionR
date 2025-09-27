<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Insertar estados
        DB::table('estados')->insertOrIgnore([
            ['id_estado' => 1, 'descripcion' => 'Disponible'],
            ['id_estado' => 2, 'descripcion' => 'En tratamiento'],
            ['id_estado' => 3, 'descripcion' => 'Adoptado'],
            ['id_estado' => 4, 'descripcion' => 'En proceso de adopción'],
            ['id_estado' => 5, 'descripcion' => 'En recuperación'],
            ['id_estado' => 6, 'descripcion' => 'No disponible'],
            ['id_estado' => 7, 'descripcion' => 'Fallecido'],
        ]);

        // Insertar tipos de documento
        DB::table('tipo_docum')->insertOrIgnore([
            ['id_tipo' => 1, 'nombre_tipo' => 'Cédula de Ciudadanía'],
            ['id_tipo' => 2, 'nombre_tipo' => 'Cédula de Extranjería'],
            ['id_tipo' => 3, 'nombre_tipo' => 'Pasaporte'],
            ['id_tipo' => 4, 'nombre_tipo' => 'NIT'],
        ]);

        // Insertar razas
        DB::table('razas')->insertOrIgnore([
            ['id_raza' => 1, 'nombre_raza' => 'Koker'],
            ['id_raza' => 3, 'nombre_raza' => 'Fold'],
            ['id_raza' => 4, 'nombre_raza' => 'Golden'],
            ['id_raza' => 5, 'nombre_raza' => 'cocker'],
        ]);

        // Insertar localidades
        $localidades = [
            ['id_localidad' => 1, 'nombre_localidad' => 'Antonio Nariño'],
            ['id_localidad' => 2, 'nombre_localidad' => 'Barrios Unidos'],
            ['id_localidad' => 3, 'nombre_localidad' => 'Bosa'],
            ['id_localidad' => 4, 'nombre_localidad' => 'Chapinero'],
            ['id_localidad' => 5, 'nombre_localidad' => 'Ciudad Bolívar'],
            ['id_localidad' => 6, 'nombre_localidad' => 'Engativá'],
            ['id_localidad' => 7, 'nombre_localidad' => 'Fontibón'],
            ['id_localidad' => 8, 'nombre_localidad' => 'Kennedy'],
            ['id_localidad' => 9, 'nombre_localidad' => 'La Candelaria'],
            ['id_localidad' => 10, 'nombre_localidad' => 'Los Mártires'],
            ['id_localidad' => 11, 'nombre_localidad' => 'Puente Aranda'],
            ['id_localidad' => 12, 'nombre_localidad' => 'Rafael Uribe Uribe'],
            ['id_localidad' => 13, 'nombre_localidad' => 'San Cristóbal'],
            ['id_localidad' => 14, 'nombre_localidad' => 'Santa Fe'],
            ['id_localidad' => 15, 'nombre_localidad' => 'Suba'],
            ['id_localidad' => 16, 'nombre_localidad' => 'Sumapaz'],
            ['id_localidad' => 17, 'nombre_localidad' => 'Teusaquillo'],
            ['id_localidad' => 18, 'nombre_localidad' => 'Tunjuelito'],
            ['id_localidad' => 19, 'nombre_localidad' => 'Usaquén'],
            ['id_localidad' => 20, 'nombre_localidad' => 'Usme'],
        ];
        
        DB::table('localidad_usu')->insertOrIgnore($localidades);

        // Insertar algunas condiciones especiales
        DB::table('detalle_condicion')->insertOrIgnore([
            ['id_condicion' => 16, 'descripcion' => 'Mordelon'],
            ['id_condicion' => 19, 'descripcion' => 'Lindo'],
        ]);
    }
}