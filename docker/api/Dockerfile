FROM php:8.0.10-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www

COPY ./api/.env.example /var/www/api/.env

WORKDIR /var/www/api

RUN composer install

RUN php artisan key:generate --ansi

RUN php artisan config:cache

RUN php artisan storage:link

EXPOSE 8000