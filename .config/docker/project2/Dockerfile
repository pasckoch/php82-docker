FROM php:8.2-fpm

WORKDIR project2

RUN apt-get update && apt-get install -y \
    		libfreetype-dev \
    		libjpeg62-turbo-dev \
    		libpng-dev \
            libzip-dev \
            libicu-dev \
            libxml2-dev \
            libxslt-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install intl \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install soap \
    && docker-php-ext-install sockets \
    && docker-php-ext-install xsl \
    && docker-php-ext-install zip

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY composer.json composer.json
COPY composer.lock composer.lock
COPY auth.json auth.json

RUN composer update

COPY . .

RUN composer dump-autoload

