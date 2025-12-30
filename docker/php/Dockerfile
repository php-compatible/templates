FROM php:5.6-cli

# Fix Debian Jessie EOL repositories
RUN echo "deb http://archive.debian.org/debian/ jessie main" > /etc/apt/sources.list \
 && echo "deb http://archive.debian.org/debian-security jessie/updates main" >> /etc/apt/sources.list \
 && echo 'Acquire::Check-Valid-Until "false";' > /etc/apt/apt.conf.d/99no-check-valid

# Install system deps
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libxml2-dev \
    wget \
 && docker-php-ext-install \
    mbstring \
 && pecl install xdebug-2.5.5 \
 && docker-php-ext-enable xdebug

# Copy PHP config
COPY docker/php/php.ini /usr/local/etc/php/php.ini

WORKDIR /app

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php --1 \
 && mv composer.phar /usr/local/bin/composer \
 && rm composer-setup.php
