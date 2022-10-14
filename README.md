# Installation

Не стоит в README указывать `composer require` потому что мы формируем `composer.json` и `composer.lock`
и далее просто будет выполняться `composer install`

- Change `filesystem` in `.env` file
- Execute command`php artisan storage:link`
- Uncomment `fileinfo` extension in `php.ini` file
- Execute command`php artisan telescope:install`
- Enable `pdo_mysql` extension in `php.ini` file
- Execute command `php artisan migrate`

# Deploy
