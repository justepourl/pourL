FROM php:8.4-apache

RUN apt-get update && apt-get install -y libsqlite3-dev git unzip curl libpng-dev libonig-dev libxml2-dev && \
    docker-php-ext-install pdo pdo_sqlite mbstring exif pcntl bcmath gd && \
    a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY .docker/entrypoint.sh /entrypoint.sh

RUN cd /var/www/html && cp .env.example .env

RUN cd /var/www/html && composer install --no-dev --no-interaction --optimize-autoloader

RUN chmod +x /entrypoint.sh

ENV APP_ENV=production
ENV APP_DEBUG=false
ENV APP_URL=https://pour-lina.onrender.com

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
CMD ["apache2-foreground"]
