FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_sqlite

RUN a2enmod rewrite

COPY . /var/www/html

COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

RUN cd /var/www/html && cp .env.example .env && php artisan key:generate --force

ENV APP_ENV=production
ENV APP_DEBUG=false
ENV DB_CONNECTION=sqlite

EXPOSE 80
