FROM php:8.2-apache

RUN apt-get update && apt-get install -y libsqlite3-dev git unzip curl && \
    docker-php-ext-install pdo pdo_sqlite && \
    a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    cd /var/www/html && \
    mv .env.example .env && \
    composer install --no-dev --no-interaction --optimize-autoloader && \
    php artisan key:generate --force && \
    php artisan config:cache

ENV APP_ENV=production
ENV APP_DEBUG=false
ENV DB_CONNECTION=sqlite

EXPOSE 80
