# Procfile
web: vendor/bin/heroku-php-nginx -C nginx.conf public/
release: php artisan migrate --force && php artisan cache:clear && php artisan config:cache
worker: php artisan queue:work --tries=3
scheduler: while [ true ]; do php artisan schedule:run --verbose --no-interaction & sleep 60; done