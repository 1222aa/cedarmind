FROM php:8.2-cli

WORKDIR /app

# Install dependencies
RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    git \
    curl \
    unzip \
    --no-install-recommends && \
    rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite

# Install composer
COPY --from=composer:2.5 /usr/bin/composer /usr/local/bin/composer

# Copy application
COPY . /app

# Delete lock file to force fresh install
RUN rm -f composer.lock

# Configure composer
RUN composer config --no-plugins allow-plugins.barryvdh/laravel-dompdf true && \
    composer config --no-plugins allow-plugins.laravel/sail true

# Install dependencies
ENV COMPOSER_MEMORY_LIMIT=-1
RUN composer update --no-dev --no-interaction --prefer-dist 2>&1 | tail -20 || true

# Ensure vendor exists
RUN if [ ! -d "vendor" ]; then echo "Vendor missing, trying install..."; composer install --no-dev --no-interaction --prefer-dist 2>&1 | tail -20 || true; fi

# Setup storage
RUN mkdir -p storage/framework/{cache,sessions} storage/logs storage/app && \
    chmod -R 777 storage bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]



