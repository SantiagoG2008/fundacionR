<?php
// fix_koyeb_env.php - Script específico para Koyeb

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== SOLUCIONADOR DE PROBLEMAS KOYEB (SIN .ENV) ===\n\n";

// 1. Verificar variables de entorno
echo "1. Verificando variables de entorno...\n";
$requiredVars = [
    'DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD'
];

$missingVars = [];
foreach ($requiredVars as $var) {
    if (empty($_ENV[$var]) && empty($_SERVER[$var])) {
        $missingVars[] = $var;
    }
}

if (!empty($missingVars)) {
    echo "❌ Variables faltantes: " . implode(', ', $missingVars) . "\n";
    echo "Configura estas variables en Koyeb Dashboard → Settings → Environment Variables\n\n";
    echo "Variables requeridas:\n";
    echo "- DB_HOST=mysql-3ae.koyeb.app\n";
    echo "- DB_DATABASE=defaultdb\n";
    echo "- DB_USERNAME=koyeb\n";
    echo "- DB_PASSWORD=[TU_PASSWORD_DE_KOYEB]\n";
    exit(1);
} else {
    echo "✅ Variables de entorno configuradas correctamente\n\n";
}

// 2. Verificar conexión a base de datos
echo "2. Verificando conexión a base de datos...\n";
try {
    $pdo = new PDO(
        'mysql:host=' . ($_ENV['DB_HOST'] ?? $_SERVER['DB_HOST']) . 
        ';port=' . ($_ENV['DB_PORT'] ?? $_SERVER['DB_PORT'] ?? '3306') . 
        ';dbname=' . ($_ENV['DB_DATABASE'] ?? $_SERVER['DB_DATABASE']),
        $_ENV['DB_USERNAME'] ?? $_SERVER['DB_USERNAME'],
        $_ENV['DB_PASSWORD'] ?? $_SERVER['DB_PASSWORD']
    );
    echo "✅ Conexión a base de datos exitosa\n\n";
} catch (Exception $e) {
    echo "❌ Error de conexión: " . $e->getMessage() . "\n";
    exit(1);
}

// 3. Ejecutar migraciones
echo "3. Ejecutando migraciones...\n";
try {
    $kernel->call('migrate', ['--force' => true]);
    echo "✅ Migraciones ejecutadas\n\n";
} catch (Exception $e) {
    echo "❌ Error al ejecutar migraciones: " . $e->getMessage() . "\n";
    exit(1);
}

// 4. Poblar base de datos
echo "4. Poblando base de datos...\n";
try {
    $kernel->call('db:seed', ['--force' => true]);
    echo "✅ Base de datos poblada\n\n";
} catch (Exception $e) {
    echo "❌ Error al poblar base de datos: " . $e->getMessage() . "\n";
    exit(1);
}

// 5. Limpiar caché
echo "5. Limpiando caché...\n";
try {
    $kernel->call('config:clear');
    $kernel->call('cache:clear');
    $kernel->call('view:clear');
    echo "✅ Caché limpiado\n\n";
} catch (Exception $e) {
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

    echo "Estados: " . $estadosCount . "\n";
    echo "Razas: " . $razasCount . "\n";
    echo "Tipos de documento: " . $tiposDocCount . "\n";
    echo "Localidades: " . $localidadesCount . "\n";
    echo "✅ Sistema configurado correctamente\n\n";
} catch (Exception $e) {
    echo "❌ Error al verificar funcionamiento: " . $e->getMessage() . "\n";
    exit(1);
}

echo "🎉 ¡SISTEMA CONFIGURADO EXITOSAMENTE!\n";
echo "Tu aplicación debería funcionar en: https://gigantic-rosmunda-rescataamor-30581165.koyeb.app\n";

$kernel->terminate();
