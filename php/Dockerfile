# php/Dockerfile
FROM php:8.2-fpm

# ติดตั้ง dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    zip \
    dom \ 
    xml \
    && docker-php-ext-install pdo pdo_mysql mysqli