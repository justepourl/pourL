#!/bin/bash
cd /var/www/html

# Ensure storage directories exist and are writable
mkdir -p storage/framework/cache storage/framework/views storage/framework/sessions storage/logs
chown -R www-data:www-data storage bootstrap/cache .env
chmod -R 775 storage bootstrap/cache

# Generate APP_KEY if not set
php artisan key:generate --force

# Cache config for production
php artisan config:cache || true

exec "$@"
