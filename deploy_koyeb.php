<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

echo "=== SCRIPT DE DESPLIEGUE PARA KOYEB ===\n";

try {
    echo "1. Verificando conexión a base de datos...\n";
    DB::connection()->getPdo();
    echo "✅ Conexión exitosa\n";
    
    echo "\n2. Ejecutando migraciones...\n";
    Artisan::call('migrate', ['--force' => true]);
    echo "✅ Migraciones ejecutadas\n";
    
    echo "\n3. Poblando base de datos con datos iniciales...\n";
    Artisan::call('db:seed', ['--force' => true]);
    echo "✅ Base de datos poblada\n";
    
    echo "\n4. Limpiando caché...\n";
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    echo "✅ Caché limpiado\n";
    
    echo "\n5. Verificando funcionamiento...\n";
    
    // Verificar que las tablas tengan datos
    $estados = DB::table('estados')->count();
    $razas = DB::table('razas')->count();
    $tipos = DB::table('tipo_docum')->count();
    $localidades = DB::table('localidad_usu')->count();
    
    echo "Estados: {$estados}\n";
    echo "Razas: {$razas}\n";
    echo "Tipos de documento: {$tipos}\n";
    echo "Localidades: {$localidades}\n";
    
    if ($estados > 0 && $razas > 0 && $tipos > 0 && $localidades > 0) {
        echo "✅ Sistema configurado correctamente\n";
        echo "\n🎉 DESPLIEGUE EXITOSO!\n";
        echo "El sistema está listo para usar.\n";
    } else {
        echo "❌ Error: Faltan datos en la base de datos\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error durante el despliegue: " . $e->getMessage() . "\n";
    echo "Archivo: " . $e->getFile() . "\n";
    echo "Línea: " . $e->getLine() . "\n";
    exit(1);
}
