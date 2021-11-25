#!/bin/bash

cd /var/www/api

php artisan migrate:fresh --force --seed
php artisan serve --host=0.0.0.0 --port=8000
