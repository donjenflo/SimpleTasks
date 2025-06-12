Установка проекта:

```cp .env.example .env
composer install
php artisan key:generate

./vendor/bin/sail build
./vendor/bin/sail up -d
```
Запуск тестов
```
./vendor/bin/sail artisan test 
```
Генерация документации (swagger файл будет в ./public/docs)
Запускать сразу после тестов
Смотреть http://localhost/docs
```
./vendor/bin/sail artisan scribe:generate --force 
```
Для тестирования оповещений пользователей используется Mailpit
http://localhost:8025/

В проекте используются очереди и планировщик, запускать так
```
./vendor/bin/sail artisan schedule:work 
./vendor/bin/sail artisan queue:work 

```
