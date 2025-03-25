FROM php:8.4-cli

# Dépendances système
RUN apt-get update && apt-get install -y \
    zip unzip curl git sqlite3 libsqlite3-dev libzip-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Créer et positionner le dossier de travail
WORKDIR /var/www

# Copier le code source
COPY . .

# Copier le fichier .env si besoin
RUN cp .env.example .env && \
    grep -q '^APP_KEY=' .env || echo 'APP_KEY=' >> .env

# Donner les bons droits
RUN chown -R www-data:www-data /var/www

# Installer les dépendances Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Donner les permissions à storage & bootstrap
RUN chmod -R 775 storage bootstrap/cache

# Exposer le port
EXPOSE 8000
