<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Требование к среде

PHP 8.2
MySQL
NPM
composer

## Предварительная настройка

.env.example переименовать .env

Переопределить переменные среды
:
```dotenv

APP_URL=

DB_DATABASE=zems_pro
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_USERNAME=homestead
DB_PASSWORD=secret

```
## Подьем проекта

В папке с проектом выполнить последовательно

- composer install
- php artisan migrate --seed
- npm run build

## Вход/Регистрация

После успешной миграции и сидирования, в бд будут добавлены изначальные данные, в консоли будет вывод 3х email,
их можно использовать для входа либо можно создать нового пользователя.
