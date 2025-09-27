<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

echo "=== SOLUCIONADOR DE PROBLEMAS KOYEB ===\n";

try {
    echo "1. Generando clave de aplicación...\n";
    Artisan::call('key:generate', ['--force' => true]);
    echo "✅ Clave de aplicación generada\n";
    
    echo "\n2. Verificando conexión a base de datos...\n";
    DB::connection()->getPdo();
    echo "✅ Conexión a BD exitosa\n";
    
    echo "\n3. Verificando datos en la base de datos...\n";
    $estados = DB::table('estados')->count();
    $razas = DB::table('razas')->count();
    echo "Estados: {$estados}\n";
    echo "Razas: {$razas}\n";
    
    if ($estados == 0 || $razas == 0) {
        echo "\n4. Repoblando base de datos...\n";
        Artisan::call('db:seed', ['--force' => true]);
        echo "✅ Base de datos repoblada\n";
    }
    
    echo "\n5. Limpiando todo el caché...\n";
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    echo "✅ Caché completamente limpiado\n";
    
    echo "\n6. Verificando configuración...\n";
    $appKey = env('APP_KEY');
    if (empty($appKey)) {
        echo "❌ APP_KEY aún está vacía\n";
        echo "Intentando generar nuevamente...\n";
        
        // Generar clave manualmente
        $key = 'base64:' . base64_encode(random_bytes(32));
        file_put_contents('.env', str_replace(
            'APP_KEY=',
            'APP_KEY=' . $key,
            file_get_contents('.env')
        ));
        echo "✅ APP_KEY configurada manualmente\n";
    } else {
        echo "✅ APP_KEY configurada: " . substr($appKey, 0, 10) . "...\n";
    }
    
    echo "\n7. Verificación final...\n";
    
    // Probar crear una mascota
    $estado = DB::table('estados')->first();
    $raza = DB::table('razas')->first();
    
    if ($estado && $raza) {
        $mascotaId = DB::table('mascota')->insertGetId([
            'nombre_mascota' => 'Test Koyeb',
            'edad' => 1,
            'vacunado' => 1,
            'peligroso' => 0,
            'esterilizado' => 1,
            'destetado' => 1,
            'genero' => 'Macho',
            'crianza' => 0,
            'fecha_ingreso' => date('Y-m-d'),
            'estado_id' => $estado->id_estado,
            'raza_id' => $raza->id_raza,
            'condiciones_especiales' => 0
        ]);
        
        if ($mascotaId) {
            echo "✅ Prueba de inserción exitosa - ID: {$mascotaId}\n";
            
            // Limpiar la mascota de prueba
            DB::table('mascota')->where('id_mascota', $mascotaId)->delete();
        }
    }
    
    echo "\n🎉 PROBLEMAS SOLUCIONADOS!\n";
    echo "El sistema debería funcionar correctamente ahora.\n";
    echo "Prueba acceder a tu aplicación en Koyeb.\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Archivo: " . $e->getFile() . "\n";
    echo "Línea: " . $e->getLine() . "\n";
    exit(1);
}
