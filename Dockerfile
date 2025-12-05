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

# Copy entire app including vendor
COPY . /app

# Just in case vendor is missing, try to install
RUN if [ ! -d "/app/vendor" ]; then \
        curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
        cd /app && composer install --no-dev --no-interaction --prefer-dist 2>&1 || echo "Composer install skipped"; \
    fi

# Setup storage
RUN mkdir -p storage/framework/{cache,sessions} storage/logs storage/app && \
    chmod -R 777 storage bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]




