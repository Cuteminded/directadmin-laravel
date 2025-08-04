# directadmin-laravel
 Run DirectAdmin commands through your laravel application

## Installation

You can install the package via composer:

```bash
composer require cuteminded/directadmin-laravel
```

Add the Service Provider and Facade to your ```app.php``` config file if you're not using Package Discovery.

```php
// config/app.php

'providers' => [
    ...
    cuteminded\DirectadminLaravel\DirectAdminServiceProvider::class,
    ...
];

'aliases' => [
    ...
    'DirectAdmin' => cuteminded\DirectadminLaravel\DirectAdmin::class,
    ...
];
```

Publish the config file using the artisan CLI tool:

```bash
php artisan vendor:publish --provider="cuteminded\DirectadminLaravel\DirectAdminServiceProvider"
```

.env keys

```.env
DIRECTADMIN_HOST=""
DIRECTADMIN_DOMAIN=""
DIRECTADMIN_USERNAME=""
DIRECTADMIN_PASSWORD=""
DIRECTADMIN_CACERT="cacert.pem"
```

## Usage

Test the connection

```php
Directadmin::checkConnection();
```

Current domain Information

```php
Directadmin::domainInformation();
```

List User statistics

```php
Directadmin::UserStatistics();
```

List email accounts of current domain

```php
Directadmin::emailInformation();
```

List system information from a DirectAdmin server

```php
Directadmin::systemInformation();
```

Domain pointers
```php
// add a new pointer
Directadmin::createDomainPointer('example.com',true);

//remove a pointer
Directadmin::removeDomainPointer('example.com',true);
```
- **$pointer** (string): The domain name to be added as a pointer.
- **$alias** (boolean, optional, default: true): Determines whether the pointer should be treated as an alias or not.
