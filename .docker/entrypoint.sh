#!/bin/bash
cd /var/www/html

mkdir -p storage/framework/cache storage/framework/views storage/framework/sessions storage/logs
chown -R www-data:www-data storage bootstrap/cache

# Cache config at runtime (stderr goes to Apache logs)
php artisan config:cache 2>&1 || echo "config:cache failed (non-fatal)"

exec "$@"
