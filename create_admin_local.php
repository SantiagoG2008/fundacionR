<?php
// create_admin_local.php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== CREANDO USUARIO ADMIN EN LOCAL ===\n\n";

try {
    // Verificar si ya existe
    $existingUser = \App\Models\User::where('email', 'admin@rescataamor.com')->first();
    
    if ($existingUser) {
        echo "✅ Usuario admin ya existe\n";
        echo "   ID: " . $existingUser->id . "\n";
        echo "   Email: " . $existingUser->email . "\n";
        echo "   Nombre: " . $existingUser->name . "\n";
        
        // Actualizar contraseña por si acaso
        $existingUser->password = bcrypt('admin123');
        $existingUser->save();
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
        echo "   Email: " . $adminUser->email . "\n";
        echo "   Nombre: " . $adminUser->name . "\n\n";
    }
    
    // Verificar total de usuarios
    $totalUsers = \App\Models\User::count();
    echo "Total de usuarios en la base de datos: " . $totalUsers . "\n\n";
    
    echo "🎉 ¡USUARIO ADMIN CONFIGURADO!\n";
    echo "Credenciales de acceso:\n";
    echo "Email: admin@rescataamor.com\n";
    echo "Password: admin123\n";
    echo "URL: http://127.0.0.1:8000/login\n";
    
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}

$kernel->terminate(null, 0);
