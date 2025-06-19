#!/bin/bash

cd /var/www

if [ ! -f ".env" ]; then
    cp .env.example .env
fi
composer install
php artisan key:generate
php artisan optimize
php artisan serve --host=0.0.0.0 --port=88

php-fpm