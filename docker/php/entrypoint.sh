#!/bin/bash

set -e

# localではmigrateのみ
# php aritsan migrate

php artisan migrate:fresh

php-fpm

exec "$@"
