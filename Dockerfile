FROM heroku/heroku:22-build

WORKDIR /app

# Install PHP
RUN apt-get update && apt-get install -y php php-cli php-fpm php-curl php-sqlite3 php-mbstring composer

# Copy app
COPY . /app

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Create storage dirs
RUN mkdir -p storage/framework/{cache,sessions} storage/logs && chmod -R 777 storage bootstrap/cache

# Generate key
RUN php artisan key:generate || true

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
