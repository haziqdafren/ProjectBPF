#!/usr/bin/env bash
# Render.com build script

set -o errexit

echo "==> Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "==> Running database migrations..."
php artisan migrate --force

echo "==> Creating demo user (will skip if already exists)..."
php artisan db:seed --class=DemoUserSeeder --force || echo "Demo user already exists or seeding skipped"

echo "==> Clearing old cache..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "==> Caching Laravel configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Creating storage link..."
php artisan storage:link || echo "Storage link already exists"

echo "==> Build completed successfully!"
