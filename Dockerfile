FROM php:8.2-fpm

# Встановлення системних залежностей (додано libpq-dev для PostgreSQL)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev

# Встановлення PHP розширень
RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Встановлення Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Встановлення залежностей Laravel
RUN composer install --no-dev --optimize-autoloader

# Запуск сервера
CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 10000
