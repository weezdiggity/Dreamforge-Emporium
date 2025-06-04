FROM php:8.4-fpm

# Set working directory early
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libonig-dev \
    mariadb-client \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    libzip-dev \
    unzip \
    git \
    curl \
    dos2unix \
    pkg-config \
    libffi-dev

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy entire Laravel app BEFORE running composer
COPY . /var/www

# Now install PHP extensions
RUN docker-php-ext-install ffi pdo_mysql mbstring zip exif pcntl && \
    docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-install gd

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Set correct permissions for Laravel
RUN chown -R www-data:www-data /var/www && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Copy .env file
COPY .env /var/www/.env

# Cache Laravel config (only works after .env + vendor + artisan are present)
RUN php artisan config:clear && php artisan config:cache

# Entrypoint (optional)
COPY docker/entrypoint.sh /usr/local/bin/entrypoint
RUN dos2unix /usr/local/bin/entrypoint && chmod +x /usr/local/bin/entrypoint

# Command
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
