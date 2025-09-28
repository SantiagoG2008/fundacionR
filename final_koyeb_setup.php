<?php
// final_koyeb_setup.php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== CONFIGURACIÓN FINAL DE KOYEB ===\n\n";

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

// 4. Crear usuario admin por defecto
echo "4. Creando usuario administrador...\n";
try {
    \App\Models\User::create([
        'name' => 'Administrador',
        'email' => 'admin@rescataamor.com',
        'password' => bcrypt('admin123'),
        'email_verified_at' => now(),
    ]);
    echo "✅ Usuario administrador creado\n";
    echo "   Email: admin@rescataamor.com\n";
    echo "   Password: admin123\n\n";
} catch (\Exception $e) {
    echo "⚠️  Usuario administrador ya existe o error: " . $e->getMessage() . "\n\n";
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

// 6. Verificar funcionamiento
echo "6. Verificando funcionamiento...\n";
try {
    $estadosCount = \App\Models\Estado::count();
    $razasCount = \App\Models\Raza::count();
    $tiposDocCount = \App\Models\TipoDocum::count();
    $localidadesCount = \App\Models\LocalidadUsu::count();
    $usersCount = \App\Models\User::count();

    echo "Estados: " . $estadosCount . "\n";
    echo "Razas: " . $razasCount . "\n";
    echo "Tipos de documento: " . $tiposDocCount . "\n";
    echo "Localidades: " . $localidadesCount . "\n";
    echo "Usuarios: " . $usersCount . "\n";
    echo "✅ Sistema configurado correctamente\n\n";
} catch (\Exception $e) {
    echo "❌ Error al verificar funcionamiento: " . $e->getMessage() . "\n";
    exit(1);
}

echo "🎉 ¡CONFIGURACIÓN FINAL COMPLETADA!\n";
echo "Tu aplicación está lista en: https://gigantic-rosmunda-rescataamor-30581165.koyeb.app\n";
echo "Usuario: admin@rescataamor.com\n";
echo "Password: admin123\n";

// Terminar correctamente el kernel
$kernel->terminate(null, 0);
