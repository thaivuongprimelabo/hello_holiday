#!/bin/sh

# Docker用 の define.php の展開
cp /var/www/includes/define.php.local /var/www/includes/define.php

# public/ に移植したシステムの環境整備
cd /var/www/includes

# composerの実行
export COMPOSER_ALLOW_SUPERUSER=1
php -d memory_limit=-1 /usr/bin/composer --no-interaction install


# laravel 環境整備
cd /var/www/laravel
cp .env.local .env

# composerの実行
export COMPOSER_ALLOW_SUPERUSER=1
php -d memory_limit=-1 /usr/bin/composer --no-interaction install

# マイグレーション＆seederの実行
php -d memory_limit=-1 artisan migrate --seed
DB_DATABASE=kaitorimega_adm_test php -d memory_limit=-1 artisan migrate --seed

# キャッシュクリア
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

