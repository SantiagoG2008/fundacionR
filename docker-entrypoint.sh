#!/bin/bash

echo "Starting Laravel application initialization..."

# Limpiar todos los cachés
echo "Clearing all caches..."
rm -rf bootstrap/cache/*
rm -rf storage/framework/cache/*
rm -rf storage/framework/sessions/*
rm -rf storage/framework/views/*

# Regenerar autoloader
echo "Regenerating autoloader..."
composer dump-autoload --no-scripts
composer dump-autoload --optimize --no-scripts

# Limpiar cachés de Laravel
echo "Clearing Laravel caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
php artisan clear-compiled
php artisan optimize:clear

# Ejecutar migraciones
echo "Running migrations..."
php artisan migrate --force

echo "Initialization complete. Starting supervisor..."
exec /usr/bin/supervisord -c /etc/supervisord.conf
