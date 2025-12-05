FROM php:8.2

WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    sqlite3 \
    libsqlite3-dev \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite

# Download and install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy only composer files first
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev --no-scripts --no-autoloader

# Copy rest of application
COPY . .

# Complete composer install
RUN composer dump-autoload --no-dev --optimize

# Create necessary directories
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/logs storage/app && \
    chmod -R 777 storage bootstrap/cache

# Run migrations (optional, may fail but continue)
RUN php artisan migrate:fresh --force --no-interaction 2>&1 || true

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
