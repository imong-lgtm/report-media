#!/bin/sh

# Create sqlite database if it doesn't exist
touch /var/www/database/database.sqlite

# Run migrations and seeders
php artisan migrate --force --seed

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the application
php artisan serve --host=0.0.0.0 --port=8080
