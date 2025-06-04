FROM php:8.4-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
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
    libffi-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install ffi pdo_mysql mbstring zip exif pcntl && \
    docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-install gd

# Enable and configure opcache only if OPCACHE_ENABLE is set to "1"
ARG OPCACHE_ENABLE=0
RUN if [ "$OPCACHE_ENABLE" = "1" ]; then \
    docker-php-ext-install opcache && \
    { \
        echo 'opcache.memory_consumption=128'; \
        echo 'opcache.interned_strings_buffer=8'; \
        echo 'opcache.max_accelerated_files=4000'; \
        echo 'opcache.revalidate_freq=60'; \
        echo 'opcache.fast_shutdown=1'; \
        echo 'opcache.enable_cli=1'; \
        echo 'opcache.enable=1'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini; \
fi

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy Composer files
COPY composer.lock composer.json ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy Laravel application code
COPY . .

# Copy .env file (be sure it's not ignored in .dockerignore or .gitignore)
COPY .env /var/www/.env

# Ensure correct permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Clear and cache Laravel config
RUN php artisan config:clear && php artisan config:cache

# Optional: set up Rust (if your app uses it)
ENV PATH="/root/.cargo/bin:${PATH}"
RUN curl https://sh.rustup.rs -sSf | sh -s -- -y && \
    echo 'source $HOME/.cargo/env' >> ~/.bashrc

# Copy and prepare entrypoint
COPY docker/entrypoint.sh /usr/local/bin/entrypoint
RUN dos2unix /usr/local/bin/entrypoint && \
    chmod +x /usr/local/bin/entrypoint

# Start Laravel development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
