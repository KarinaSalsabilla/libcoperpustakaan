FROM php:8.2-cli

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    curl

# Install Node.js 20
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

RUN docker-php-ext-configure gd --with-freetype \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mbstring zip bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --optimize-autoloader --no-scripts --no-interaction

RUN npm install && npm run build

RUN rm -rf bootstrap/cache/*.php

EXPOSE 8000

CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=$((PORT+0))"]