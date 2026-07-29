#!/bin/bash
cd /var/www/html

mkdir -p storage/framework/cache storage/framework/views storage/framework/sessions storage/logs
chown -R www-data:www-data storage bootstrap/cache

exec "$@"
