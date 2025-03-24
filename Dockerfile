FROM php:8.4-fpm

# Installer extensions nécessaires
RUN apt-get update && apt-get install -y \
    zip unzip curl git sqlite3 libsqlite3-dev libzip-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Créer l'utilisateur Laravel
RUN useradd -G www-data,root -u 1000 -d /home/laravel laravel && \
    mkdir -p /home/laravel && chown -R laravel:laravel /home/laravel

# Définir le dossier de travail
WORKDIR /var/www

# Copier les fichiers
COPY . .

# Installer les dépendances PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Permissions
RUN chown -R laravel:www-data /var/www && chmod -R 775 /var/www/storage

USER laravel

CMD php artisan serve --host=0.0.0.0 --port=8000
