FROM php:8.2-cli

WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    sqlite3 \
    libsqlite3-dev \
    && rm -rf /var/lib/apt/lists/*

# Install only essential PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite

# Increase memory limit for Composer
ENV COMPOSER_MEMORY_LIMIT=-1

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /app

# Install dependencies with verbose output
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --verbose

# Create storage directories
RUN mkdir -p /app/storage /app/bootstrap/cache /var/data && \
    chmod -R 755 /app/storage /app/bootstrap/cache

# Generate app key if needed
RUN php artisan key:generate || true

# Run migrations
RUN php artisan migrate --force || true

# Expose port
EXPOSE 10000

# Start Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
