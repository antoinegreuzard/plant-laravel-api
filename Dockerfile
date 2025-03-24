FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    zip unzip curl git sqlite3 libsqlite3-dev libzip-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

RUN cp .env.example .env

# Assure que le dossier existe avant install
RUN mkdir -p /var/www/storage && chmod -R 775 /var/www/storage

RUN git config --global --add safe.directory /var/www && \
    composer install --no-interaction --prefer-dist --optimize-autoloader

CMD php artisan serve --host=0.0.0.0 --port=8000
