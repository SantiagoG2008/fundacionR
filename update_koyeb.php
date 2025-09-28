<?php
// update_koyeb.php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== ACTUALIZACIÓN COMPLETA DE KOYEB ===\n\n";

// 1. Verificar conexión a base de datos
echo "1. Verificando conexión a base de datos...\n";
try {
    \Illuminate\Support\Facades\DB::connection()->getPdo();
    echo "✅ Conexión exitosa\n\n";
} catch (\Exception $e) {
    echo "❌ Error de conexión: " . $e->getMessage() . "\n";
    exit(1);
}

// 2. Recrear estructura de base de datos
echo "2. Recreando estructura de base de datos...\n";
try {
    // Eliminar todas las tablas
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
        'razas',
        'password_resets',
        'users',
        'failed_jobs',
        'personal_access_tokens'
    ];
    
    foreach ($tables as $table) {
        try {
            \Illuminate\Support\Facades\DB::statement("DROP TABLE IF EXISTS `$table`");
            echo "     ✅ Tabla `$table` eliminada\n";
        } catch (\Exception $e) {
            echo "     ⚠️  Tabla `$table` no existía\n";
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

// 3. Poblar base de datos
echo "3. Poblando base de datos con datos iniciales...\n";
try {
    $kernel->call('db:seed', ['--force' => true]);
    echo "✅ Base de datos poblada\n\n";
} catch (\Exception $e) {
    echo "❌ Error al poblar base de datos: " . $e->getMessage() . "\n";
    exit(1);
}

// 4. Limpiar caché
echo "4. Limpiando caché...\n";
try {
    $kernel->call('config:clear');
    $kernel->call('cache:clear');
    $kernel->call('view:clear');
    echo "✅ Caché limpiado\n\n";
} catch (\Exception $e) {
    echo "❌ Error al limpiar caché: " . $e->getMessage() . "\n";
    exit(1);
}

// 5. Verificar funcionamiento
echo "5. Verificando funcionamiento...\n";
try {
    $estadosCount = \App\Models\Estado::count();
    $razasCount = \App\Models\Raza::count();
    $tiposDocCount = \App\Models\TipoDocum::count();
    $localidadesCount = \App\Models\LocalidadUsu::count();

    echo "Estados: " . $estadosCount . "\n";
    echo "Razas: " . $razasCount . "\n";
    echo "Tipos de documento: " . $tiposDocCount . "\n";
    echo "Localidades: " . $localidadesCount . "\n";
    echo "✅ Sistema configurado correctamente\n\n";
} catch (\Exception $e) {
    echo "❌ Error al verificar funcionamiento: " . $e->getMessage() . "\n";
    exit(1);
}

echo "🎉 ¡ACTUALIZACIÓN COMPLETA EXITOSA!\n";
echo "Tu aplicación debería funcionar perfectamente en: https://gigantic-rosmunda-rescataamor-30581165.koyeb.app\n";

$kernel->terminate();
