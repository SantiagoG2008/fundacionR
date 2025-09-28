<?php
// create_database_dump.php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== CREANDO DUMP DE BASE DE DATOS ===\n\n";

try {
    // Obtener configuración de base de datos
    $host = env('DB_HOST', 'localhost');
    $port = env('DB_PORT', '3306');
    $database = env('DB_DATABASE', 'fundacion');
    $username = env('DB_USERNAME', 'root');
    $password = env('DB_PASSWORD', '');
    
    echo "Conectando a: {$host}:{$port}/{$database}\n";
    
    $pdo = new PDO("mysql:host={$host};port={$port};dbname={$database}", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Crear archivo de dump
    $dumpFile = __DIR__ . '/bd/fundacion_updated.sql';
    $file = fopen($dumpFile, 'w');
    
    if (!$file) {
        throw new Exception("No se pudo crear el archivo de dump");
    }
    
    // Escribir header
    fwrite($file, "-- Dump de base de datos para Fundación Rescata Amor\n");
    fwrite($file, "-- Generado el: " . date('Y-m-d H:i:s') . "\n\n");
    fwrite($file, "SET FOREIGN_KEY_CHECKS=0;\n\n");
    
    // Obtener todas las tablas
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    
    foreach ($tables as $table) {
        echo "Procesando tabla: {$table}\n";
        
        // Estructura de la tabla
        $createTable = $pdo->query("SHOW CREATE TABLE `{$table}`")->fetch(PDO::FETCH_ASSOC);
        fwrite($file, "DROP TABLE IF EXISTS `{$table}`;\n");
        fwrite($file, $createTable['Create Table'] . ";\n\n");
        
        // Datos de la tabla
        $data = $pdo->query("SELECT * FROM `{$table}`");
        $rows = $data->fetchAll(PDO::FETCH_ASSOC);
        
        if (!empty($rows)) {
            $columns = array_keys($rows[0]);
            $columnNames = '`' . implode('`, `', $columns) . '`';
            
            fwrite($file, "INSERT INTO `{$table}` ({$columnNames}) VALUES\n");
            
            $values = [];
            foreach ($rows as $row) {
                $escapedValues = [];
                foreach ($row as $value) {
                    if ($value === null) {
                        $escapedValues[] = 'NULL';
                    } else {
                        $escapedValues[] = $pdo->quote($value);
                    }
                }
                $values[] = '(' . implode(', ', $escapedValues) . ')';
            }
            
            fwrite($file, implode(",\n", $values) . ";\n\n");
        }
    }
    
    fwrite($file, "SET FOREIGN_KEY_CHECKS=1;\n");
    fclose($file);
    
    echo "✅ Dump creado exitosamente en: {$dumpFile}\n";
    echo "📁 Tamaño del archivo: " . number_format(filesize($dumpFile)) . " bytes\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n🎉 ¡Dump de base de datos creado exitosamente!\n";
echo "Puedes importar este archivo en phpMyAdmin o cualquier cliente MySQL.\n";
