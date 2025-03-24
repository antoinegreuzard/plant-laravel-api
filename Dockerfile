# Dockerfile
FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    zip unzip curl git sqlite3 libsqlite3-dev libzip-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

RUN cp .env.example .env
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN touch database/database.sqlite

RUN php artisan config:clear && php artisan cache:clear
RUN php artisan key:generate
RUN php artisan jwt:secret --force

RUN chown -R www-data:www-data /var/www

EXPOSE 9000
CMD ["php-fpm"]
