FROM php:8.3-fpm

ENV LOG_CHANNEL stderr

WORKDIR /var/www

RUN apt-get update \
    && apt-get -y install git zip libonig-dev libzip-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql \
    && chown -R www-data:www-data /var/www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./build/php/entrypoint.sh /usr/bin
RUN chmod +x /usr/bin/entrypoint.sh

CMD ["/usr/bin/entrypoint.sh"]
