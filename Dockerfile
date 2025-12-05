FROM php:8.2-cli

WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    sqlite3 \
    libsqlite3-dev \
    --no-install-recommends \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . /app

# Set permissions before installing
RUN mkdir -p /app/storage /app/bootstrap/cache /var/data && \
    chmod -R 777 /app/storage /app/bootstrap/cache

# Install composer dependencies
ENV COMPOSER_MEMORY_LIMIT=-1
RUN cd /app && composer install --no-dev --no-interaction --prefer-dist 2>&1 || echo "Composer install had warnings"

# Generate key and run migrations
RUN php artisan key:generate --force 2>&1 || true && \
    php artisan migrate --force --no-interaction 2>&1 || true

EXPOSE 10000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
