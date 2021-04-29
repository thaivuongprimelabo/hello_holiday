#cp .env.local .env

# composerの実行
export COMPOSER_ALLOW_SUPERUSER=1

php -d memory_limit=-1 /usr/bin/composer --no-interaction create-project laravel/laravel src

cd /var/www/src

cp .env.example .env

php -d memory_limit=-1 /usr/bin/composer --no-interaction install

# キャッシュクリア
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan key:generate

chown -R www:www /var/www/

