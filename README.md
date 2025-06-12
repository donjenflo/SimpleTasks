cp .env.example .env
composer install
php artisan key:generate

./vendor/bin/sail build
./vendor/bin/sail up -d

