#!/bin/bash

set -e

# localではmigrateのみ
# php aritsan migrate

composer install
php artisan migrate:fresh

php-fpm

exec "$@"
