FROM php:8.0-cli

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    || true

RUN docker-php-ext-configure gd --with-freetype || true

RUN docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mbstring zip bcmath || true

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --optimize-autoloader --no-scripts --no-interaction

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]