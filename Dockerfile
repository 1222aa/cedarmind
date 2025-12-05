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

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy entire application first
COPY . /app

# Install dependencies  
ENV COMPOSER_MEMORY_LIMIT=-1
RUN composer install --no-dev --no-interaction --prefer-dist --no-scripts 2>&1 || composer install --no-dev --no-interaction --prefer-dist

# Run post-install scripts
RUN composer dump-autoload --no-dev --optimize

# Setup storage
RUN mkdir -p storage/framework/{cache,sessions} storage/logs storage/app && \
    chmod -R 777 storage bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]





