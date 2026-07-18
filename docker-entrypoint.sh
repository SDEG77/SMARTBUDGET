#!/bin/sh
set -e

echo "Caching configuration.."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Running migrations..."
php artisan migrate --force
php artisan db:seed --force

echo "Starting Laravel..."
exec php artisan serve --host=0.0.0.0 --port=$PORT