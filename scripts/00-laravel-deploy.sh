#!/usr/bin/env bash
set -e

cd /var/www/html

echo "Installing Laravel dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "Preparing Laravel cache..."
php artisan config:clear
php artisan config:cache

echo "Laravel deployment preparation complete."
