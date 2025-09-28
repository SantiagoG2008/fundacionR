<?php
// fix_koyeb_login.php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== CORRECCIÓN DE LOGIN EN KOYEB ===\n\n";

// 1. Verificar conexión a base de datos
echo "1. Verificando conexión a base de datos...\n";
try {
    \Illuminate\Support\Facades\DB::connection()->getPdo();
    echo "✅ Conexión exitosa\n\n";
} catch (\Exception $e) {
    echo "❌ Error de conexión: " . $e->getMessage() . "\n";
    exit(1);
}

// 2. Verificar si el usuario admin existe
echo "2. Verificando usuario administrador...\n";
try {
    $adminUser = \App\Models\User::where('email', 'admin@rescataamor.com')->first();
    
    if ($adminUser) {
        echo "✅ Usuario admin ya existe\n";
        echo "   ID: " . $adminUser->id . "\n";
        echo "   Email: " . $adminUser->email . "\n";
        echo "   Nombre: " . $adminUser->name . "\n";
        
        // Actualizar la contraseña por si acaso
        $adminUser->password = bcrypt('admin123');
        $adminUser->save();
        echo "   ✅ Contraseña actualizada\n\n";
    } else {
        echo "⚠️  Usuario admin no existe, creándolo...\n";
        
        $adminUser = \App\Models\User::create([
            'name' => 'Administrador',
            'email' => 'admin@rescataamor.com',
            'password' => bcrypt('admin123'),
            'email_verified_at' => now(),
        ]);
        
        echo "✅ Usuario admin creado exitosamente\n";
        echo "   ID: " . $adminUser->id . "\n";
        echo "   Email: " . $adminUser->email . "\n\n";
    }
} catch (\Exception $e) {
    echo "❌ Error al manejar usuario admin: " . $e->getMessage() . "\n";
    exit(1);
}

// 3. Verificar datos de la base de datos
echo "3. Verificando datos de la base de datos...\n";
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
    echo "✅ Datos verificados correctamente\n\n";
} catch (\Exception $e) {
    echo "❌ Error al verificar datos: " . $e->getMessage() . "\n";
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

echo "🎉 ¡LOGIN CORREGIDO!\n";
echo "Credenciales de acceso:\n";
echo "Email: admin@rescataamor.com\n";
echo "Password: admin123\n";
echo "URL: https://gigantic-rosmunda-rescataamor-30581165.koyeb.app/login\n";

$kernel->terminate(null, 0);
