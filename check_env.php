<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== VERIFICACIÓN DE VARIABLES DE ENTORNO ===\n\n";

// Variables críticas a verificar
$criticalVars = [
    'APP_NAME' => 'Nombre de la aplicación',
    'APP_ENV' => 'Entorno de la aplicación',
    'APP_KEY' => 'Clave de aplicación (CRÍTICA)',
    'APP_DEBUG' => 'Modo debug',
    'APP_URL' => 'URL de la aplicación',
    'DB_CONNECTION' => 'Tipo de conexión BD',
    'DB_HOST' => 'Host de la base de datos',
    'DB_PORT' => 'Puerto de la base de datos',
    'DB_DATABASE' => 'Nombre de la base de datos',
    'DB_USERNAME' => 'Usuario de la base de datos',
    'DB_PASSWORD' => 'Contraseña de la base de datos',
    'CACHE_DRIVER' => 'Driver de caché',
    'SESSION_DRIVER' => 'Driver de sesiones'
];

echo "VARIABLES DE ENTORNO ACTUALES:\n";
echo "================================\n";

$missing = [];
$configured = [];

foreach ($criticalVars as $var => $description) {
    $value = env($var);
    
    if (empty($value)) {
        $missing[] = $var;
        echo "❌ {$var}: NO CONFIGURADA - {$description}\n";
    } else {
        $configured[] = $var;
        
        // Ocultar contraseñas
        if (strpos($var, 'PASSWORD') !== false || strpos($var, 'KEY') !== false) {
            $displayValue = substr($value, 0, 10) . '...';
        } else {
            $displayValue = $value;
        }
        
        echo "✅ {$var}: {$displayValue} - {$description}\n";
    }
}

echo "\nRESUMEN:\n";
echo "========\n";
echo "✅ Configuradas: " . count($configured) . "\n";
echo "❌ Faltantes: " . count($missing) . "\n";

if (!empty($missing)) {
    echo "\nVARIABLES QUE NECESITAS CONFIGURAR:\n";
    echo "===================================\n";
    
    foreach ($missing as $var) {
        echo "🔧 {$var}\n";
        
        // Sugerencias de valores
        switch ($var) {
            case 'APP_NAME':
                echo "   Valor sugerido: \"Fundación Rescata Amor\"\n";
                break;
            case 'APP_ENV':
                echo "   Valor sugerido: production\n";
                break;
            case 'APP_DEBUG':
                echo "   Valor sugerido: false\n";
                break;
            case 'APP_URL':
                echo "   Valor sugerido: https://gigantic-rosmunda-rescataamor-30581165.koyeb.app\n";
                break;
            case 'DB_CONNECTION':
                echo "   Valor sugerido: mysql\n";
                break;
            case 'DB_HOST':
                echo "   Valor sugerido: mysql-3ae.koyeb.app\n";
                break;
            case 'DB_PORT':
                echo "   Valor sugerido: 3306\n";
                break;
            case 'DB_DATABASE':
                echo "   Valor sugerido: defaultdb\n";
                break;
            case 'DB_USERNAME':
                echo "   Valor sugerido: koyeb\n";
                break;
            case 'CACHE_DRIVER':
                echo "   Valor sugerido: file\n";
                break;
            case 'SESSION_DRIVER':
                echo "   Valor sugerido: file\n";
                break;
        }
        echo "\n";
    }
}

// Verificar conexión a BD si está configurada
if (env('DB_HOST') && env('DB_DATABASE')) {
    echo "\nVERIFICANDO CONEXIÓN A BASE DE DATOS:\n";
    echo "====================================\n";
    
    try {
        $pdo = new PDO(
            'mysql:host=' . env('DB_HOST') . ';port=' . env('DB_PORT') . ';dbname=' . env('DB_DATABASE'),
            env('DB_USERNAME'),
            env('DB_PASSWORD')
        );
        echo "✅ Conexión a base de datos exitosa\n";
        
        // Verificar tablas
        $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
        echo "✅ Tablas encontradas: " . count($tables) . "\n";
        
    } catch (Exception $e) {
        echo "❌ Error de conexión: " . $e->getMessage() . "\n";
    }
}

if (empty($missing)) {
    echo "\n🎉 ¡TODAS LAS VARIABLES ESTÁN CONFIGURADAS!\n";
    echo "El sistema debería funcionar correctamente.\n";
} else {
    echo "\n⚠️  CONFIGURA LAS VARIABLES FALTANTES EN KOYEB\n";
    echo "Ve a: Settings → Environment Variables\n";
}
