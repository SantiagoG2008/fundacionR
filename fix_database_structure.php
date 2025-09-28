<?php
// fix_database_structure.php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== CORRECTOR DE ESTRUCTURA DE BASE DE DATOS ===\n\n";

// 1. Verificar conexión
echo "1. Verificando conexión a base de datos...\n";
try {
    \Illuminate\Support\Facades\DB::connection()->getPdo();
    echo "✅ Conexión exitosa\n\n";
} catch (\Exception $e) {
    echo "❌ Error de conexión: " . $e->getMessage() . "\n";
    exit(1);
}

// 2. Recrear todas las tablas desde cero
echo "2. Recreando estructura de base de datos...\n";
try {
    // Eliminar todas las tablas (en orden correcto por foreign keys)
    echo "   - Eliminando tablas existentes...\n";
    \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    
    $tables = [
        'detalle_donacion',
        'donaciones', 
        'imagenes',
        'historia_clinica',
        'adopciones',
        'mascota',
        'adoptantes',
        'contactos',
        'detalle_condicion',
        'barrio',
        'localidad_usu',
        'tipo_docum',
        'estados',
        'razas'
    ];
    
    foreach ($tables as $table) {
        try {
            \Illuminate\Support\Facades\DB::statement("DROP TABLE IF EXISTS `$table`");
            echo "     ✅ Tabla `$table` eliminada\n";
        } catch (\Exception $e) {
            echo "     ⚠️  Tabla `$table` no existía o no se pudo eliminar\n";
        }
    }
    
    \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    
    // Ejecutar migraciones
    echo "   - Ejecutando migraciones...\n";
    $kernel->call('migrate:fresh', ['--force' => true]);
    echo "✅ Migraciones ejecutadas\n\n";
    
} catch (\Exception $e) {
    echo "❌ Error al recrear estructura: " . $e->getMessage() . "\n";
    exit(1);
}

// 3. Poblar con datos iniciales
echo "3. Poblando base de datos con datos iniciales...\n";
try {
    $kernel->call('db:seed', ['--force' => true]);
    echo "✅ Base de datos poblada\n\n";
} catch (\Exception $e) {
    echo "❌ Error al poblar base de datos: " . $e->getMessage() . "\n";
    exit(1);
}

// 4. Verificar estructura
echo "4. Verificando estructura de tablas...\n";
try {
    $tables_to_check = [
        'razas' => 'id_raza',
        'historia_clinica' => 'id_historia', 
        'imagenes' => 'id_imagen',
        'adoptantes' => 'id_adoptante',
        'mascota' => 'id_mascota'
    ];
    
    foreach ($tables_to_check as $table => $id_field) {
        $result = \Illuminate\Support\Facades\DB::select("SHOW CREATE TABLE `$table`");
        $create_statement = $result[0]->{'Create Table'};
        
        if (strpos($create_statement, 'AUTO_INCREMENT') !== false) {
            echo "   ✅ Tabla `$table`: `$id_field` es AUTO_INCREMENT\n";
        } else {
            echo "   ❌ Tabla `$table`: `$id_field` NO es AUTO_INCREMENT\n";
        }
    }
    
    echo "\n✅ Verificación de estructura completada\n\n";
    
} catch (\Exception $e) {
    echo "❌ Error al verificar estructura: " . $e->getMessage() . "\n";
    exit(1);
}

// 5. Limpiar caché
echo "5. Limpiando caché...\n";
try {
    $kernel->call('config:clear');
    $kernel->call('cache:clear');
    $kernel->call('view:clear');
    echo "✅ Caché limpiado\n\n";
} catch (\Exception $e) {
    echo "❌ Error al limpiar caché: " . $e->getMessage() . "\n";
    exit(1);
}

echo "🎉 ¡BASE DE DATOS CORREGIDA EXITOSAMENTE!\n";
echo "Todas las tablas ahora tienen AUTO_INCREMENT correctamente configurado.\n";

$kernel->terminate();
