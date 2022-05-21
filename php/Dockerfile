FROM php:8.0-fpm


RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pgsql pdo pdo_pgsql

RUN apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip
