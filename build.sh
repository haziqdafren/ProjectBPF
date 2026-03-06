#!/usr/bin/env bash
# Render.com build script

set -o errexit

echo "Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "Running database migrations..."
php artisan migrate --force

echo "Seeding demo user..."
php artisan db:seed --class=DemoUserSeeder --force

echo "Caching Laravel configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Build completed successfully!"
