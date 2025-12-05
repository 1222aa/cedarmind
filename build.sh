#!/bin/bash
set -e

echo "Installing PHP and dependencies..."
apt-get update
apt-get install -y php php-cli php-fpm php-mysql php-sqlite3 php-xml php-curl php-mbstring composer

echo "Installing composer dependencies..."
composer install --no-dev --optimize-autoloader

echo "Running migrations..."
php artisan migrate --force

echo "Caching configuration..."
php artisan config:cache
php artisan route:cache

echo "Build complete!"
