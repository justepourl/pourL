FROM php:8.4-apache

RUN apt-get update && apt-get install -y libsqlite3-dev git unzip curl libpng-dev libonig-dev libxml2-dev && \
    docker-php-ext-install pdo pdo_sqlite mbstring exif pcntl bcmath gd && \
    a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY .docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

WORKDIR /var/www/html

RUN cp .env.example .env
RUN composer install --no-dev --no-interaction --optimize-autoloader
RUN php artisan key:generate --force
RUN touch database/database.sqlite
RUN chmod -R 775 storage bootstrap/cache

# Override .env for production
RUN sed -i 's/APP_ENV=.*/APP_ENV=production/' .env && \
    sed -i 's/APP_DEBUG=.*/APP_DEBUG=false/' .env && \
    sed -i 's|APP_URL=.*|APP_URL=https://pourl.onrender.com|' .env

RUN php artisan config:cache

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
CMD ["apache2-foreground"]
