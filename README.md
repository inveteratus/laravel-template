# Laravel-Template

A simple Laravel template with basic auth pages and some useful components.

## Installation

```shell
git clone git@github.com:inveteratus/laravel-template.git
cd laravel-template

composer install
npm install

cp .env.docker .env
php artisan key:generate

vendor/bin/sail up -d
vendor/bin/sail artisan storage:link 
vendor/bin/sail artisan migrate --seed
vendor/bin/sail npm run build
vendor/bin/sail test
```
