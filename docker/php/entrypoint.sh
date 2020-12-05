#!/bin/bash

set -e

# localではmigrateのみ
# php aritsan migrate

composer install
npm install

php artisan migrate:fresh
npm run production

php-fpm

exec "$@"
