FROM php:8.2-cli

WORKDIR /app

# Install dependencies
RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    git \
    curl \
    --no-install-recommends && \
    rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite

# Copy only composer files
COPY composer.json composer.lock ./

# Install composer and setup
COPY --from=composer:2.5 /usr/bin/composer /usr/local/bin/composer

# Pre-download composer cache to avoid timeouts
RUN composer config --no-plugins allow-plugins.barryvdh/laravel-dompdf true

# Install dependencies with maximum verbosity
ENV COMPOSER_MEMORY_LIMIT=-1
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --no-scripts \
    --quiet || true

# Now copy everything
COPY . .

# Finish composer setup
RUN composer dump-autoload --no-dev --optimize --quiet || true

# Setup storage
RUN mkdir -p storage/framework/{cache,sessions} storage/logs storage/app && \
    chmod -R 777 storage bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]


