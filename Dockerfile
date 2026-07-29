FROM php:8.2-apache

RUN apt-get update && apt-get install -y libsqlite3-dev git unzip curl libpng-dev libonig-dev libxml2-dev && \
    docker-php-ext-install pdo pdo_sqlite mbstring exif pcntl bcmath gd && \
    a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN cd /var/www/html && cp .env.example .env

RUN cd /var/www/html && composer install --no-dev --no-interaction --optimize-autoloader

RUN cd /var/www/html && php artisan key:generate --force

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

ENV APP_ENV=production
ENV APP_DEBUG=false
ENV DB_CONNECTION=sqlite

EXPOSE 80
