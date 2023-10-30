#!/bin/bash
cd /var/www/html &&
composer require laravel/socialite
composer update && composer dump-autoload &&
chmod 777 -R storage bootstrap/cache &&
php artisan optimize:clear &&
php artisan optimize &&
php artisan storage:link &&
php artisan migrate --force --seed
