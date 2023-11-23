# directadmin-laravel
 Run DirectAdmin commands through your laravel application

## Installation

You can install the package via composer:

```bash
composer require lizzy/directadmin-laravel
```

Add the Service Provider and Facade to your ```app.php``` config file if you're not using Package Discovery.

```php
// config/app.php

'providers' => [
    ...
    Lizzy\DirectadminLaravel\DirectAdminServiceProvider::class,
    ...
];

'aliases' => [
    ...
    'DirectAdmin' => Lizzy\DirectadminLaravel\DirectAdmin::class,
    ...
];
```

Publish the config file using the artisan CLI tool:

```bash
php artisan vendor:publish --provider="Lizzy\DirectadminLaravel\DirectAdminServiceProvider"
```
