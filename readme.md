## Liber - Library Management System

### Setup

```
$ composer install
$ npm install
$ gulp
```

### Testing

Create testing database:

```
$ touch storage/database.sqlite
```

Migrate database:

```
$ DB_CONNECTION=sqlite php artisan migrate
```

Run tests:

```
$ vendor/bin/phpunit
```
