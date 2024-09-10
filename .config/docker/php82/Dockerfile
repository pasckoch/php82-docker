FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
		libfreetype-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
	&& pecl install redis-6.0.2 \
        && pecl install xdebug-3.3.2 \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd \
	&& docker-php-ext-install pdo_mysql \
	&& docker-php-ext-enable redis xdebug


FROM composer:latest as vendor

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-dev \
    --prefer-dist

COPY . .
RUN composer dump-autoload
