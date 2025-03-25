FROM php:8.4-fpm

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    zip unzip curl git sqlite3 libsqlite3-dev libzip-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Préparer l'application
WORKDIR /var/www
COPY . .

# Droits
RUN chown -R www-data:www-data /var/www

# Exposer le port FPM
EXPOSE 9000

# Commande par défaut
CMD ["php-fpm"]
