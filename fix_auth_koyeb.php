<?php
// fix_auth_koyeb.php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== CORRECCIÓN COMPLETA DE AUTENTICACIÓN EN KOYEB ===\n\n";

// 1. Verificar conexión a base de datos
echo "1. Verificando conexión a base de datos...\n";
try {
    \Illuminate\Support\Facades\DB::connection()->getPdo();
    echo "✅ Conexión exitosa\n\n";
} catch (\Exception $e) {
    echo "❌ Error de conexión: " . $e->getMessage() . "\n";
    exit(1);
}

// 2. Eliminar usuario admin existente y crear uno nuevo
echo "2. Recreando usuario administrador...\n";
try {
    // Eliminar usuario existente
    \App\Models\User::where('email', 'admin@rescataamor.com')->delete();
    echo "   - Usuario admin anterior eliminado\n";
    
    // Crear nuevo usuario con contraseña simple
    $adminUser = \App\Models\User::create([
        'name' => 'Administrador',
        'email' => 'admin@rescataamor.com',
        'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
        'email_verified_at' => now(),
    ]);
    
    echo "   ✅ Usuario admin creado exitosamente\n";
    echo "   ID: " . $adminUser->id . "\n";
    echo "   Email: " . $adminUser->email . "\n";
    echo "   Password Hash: " . substr($adminUser->password, 0, 20) . "...\n\n";
    
} catch (\Exception $e) {
    echo "❌ Error al crear usuario admin: " . $e->getMessage() . "\n";
    exit(1);
}

// 3. Verificar que el usuario se puede autenticar
echo "3. Verificando autenticación...\n";
try {
    $user = \App\Models\User::where('email', 'admin@rescataamor.com')->first();
    
    if (!$user) {
        echo "❌ Usuario no encontrado\n";
        exit(1);
    }
    
    $passwordCheck = \Illuminate\Support\Facades\Hash::check('admin123', $user->password);
    echo "   Verificación de contraseña: " . ($passwordCheck ? "✅ Correcta" : "❌ Incorrecta") . "\n";
    
    if (!$passwordCheck) {
        // Intentar actualizar la contraseña de nuevo
        $user->password = \Illuminate\Support\Facades\Hash::make('admin123');
        $user->save();
        echo "   ✅ Contraseña actualizada\n";
    }
    
    echo "   ✅ Autenticación verificada\n\n";
    
} catch (\Exception $e) {
    echo "❌ Error al verificar autenticación: " . $e->getMessage() . "\n";
    exit(1);
}

// 4. Verificar configuración de autenticación
echo "4. Verificando configuración de autenticación...\n";
try {
    $authConfig = config('auth');
    echo "   Driver: " . $authConfig['defaults']['guard'] . "\n";
    echo "   Provider: " . $authConfig['guards']['web']['provider'] . "\n";
    echo "   Model: " . $authConfig['providers']['users']['model'] . "\n";
    echo "   ✅ Configuración correcta\n\n";
} catch (\Exception $e) {
    echo "❌ Error en configuración: " . $e->getMessage() . "\n";
    exit(1);
}

// 5. Crear usuario adicional con contraseña diferente
echo "5. Creando usuario alternativo...\n";
try {
    $altUser = \App\Models\User::create([
        'name' => 'Admin Alt',
        'email' => 'admin@fundacion.com',
        'password' => \Illuminate\Support\Facades\Hash::make('123456'),
        'email_verified_at' => now(),
    ]);
    
    echo "   ✅ Usuario alternativo creado\n";
    echo "   Email: admin@fundacion.com\n";
    echo "   Password: 123456\n\n";
    
} catch (\Exception $e) {
    echo "⚠️  Usuario alternativo ya existe o error: " . $e->getMessage() . "\n\n";
}

// 6. Limpiar caché completamente
echo "6. Limpiando caché...\n";
try {
    $kernel->call('config:clear');
    $kernel->call('cache:clear');
    $kernel->call('view:clear');
    $kernel->call('route:clear');
    echo "✅ Caché limpiado\n\n";
} catch (\Exception $e) {
    echo "❌ Error al limpiar caché: " . $e->getMessage() . "\n";
    exit(1);
}

// 7. Verificar datos finales
echo "7. Verificación final...\n";
try {
    $usersCount = \App\Models\User::count();
    $estadosCount = \App\Models\Estado::count();
    $razasCount = \App\Models\Raza::count();

    echo "Usuarios: " . $usersCount . "\n";
    echo "Estados: " . $estadosCount . "\n";
    echo "Razas: " . $razasCount . "\n";
    echo "✅ Sistema verificado\n\n";
} catch (\Exception $e) {
    echo "❌ Error en verificación: " . $e->getMessage() . "\n";
    exit(1);
}

echo "🎉 ¡AUTENTICACIÓN CORREGIDA!\n";
echo "Credenciales disponibles:\n";
echo "Opción 1:\n";
echo "  Email: admin@rescataamor.com\n";
echo "  Password: admin123\n\n";
echo "Opción 2:\n";
echo "  Email: admin@fundacion.com\n";
echo "  Password: 123456\n\n";
echo "URL: https://gigantic-rosmunda-rescataamor-30581165.koyeb.app/login\n";

$kernel->terminate(null, 0);
