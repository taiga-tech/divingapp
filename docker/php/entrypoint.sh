#!/bin/bash

set -e

# localではmigrateのみ
# php aritsan migrate

composer install
npm install -y

php artisan migrate:fresh
npm run production

php-fpm

exec "$@"
