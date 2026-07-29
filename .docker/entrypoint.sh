#!/bin/bash
cd /var/www/html

# Fix runtime permissions
mkdir -p storage/framework/cache storage/framework/views storage/framework/sessions storage/logs
chown -R www-data:www-data storage bootstrap/cache

exec "$@"
