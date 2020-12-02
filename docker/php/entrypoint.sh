#!/bin/bash

set -e

# localではmigrateのみ
# php aritsan migrate

npm run production

php artisan migrate:fresh

php-fpm

exec "$@"
