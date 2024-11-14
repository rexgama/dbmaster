# DBMaster Package for Laravel

A powerful Laravel package that provides dynamic schema management, automatic form generation, and a built-in admin interface.

## Features

- Zero-code column addition to database tables
- Built-in form builder with automatic generation
- Dynamic schema management
- Automatic API generation with override capability
- Built-in admin interface

## Installation

1. Install the package via Composer:
```bash
composer require rexgama/dbmaster
```

2. Publish the configuration and assets:
```bash
php artisan vendor:publish --provider="Rexgama\DBMaster\DBMasterServiceProvider"
```

3. Run the migrations:
```bash
php artisan migrate
```

## Usage

### Adding a New Column

```php
use Rexgama\DBMaster\Services\SchemaManager;

$schemaManager = app(SchemaManager::class);
$schemaManager->addColumn('users', [
    'name' => 'new_field',
    'type' => 'string',
    'validation' => ['required', 'max:255']
]);
```

### Generating a Form

```php
$form = $schemaManager->generateForm('users');
```

### Accessing the Admin Interface

Visit `/dbmaster` in your browser to access the admin interface.

## Configuration

You can modify the configuration in `config/dbmaster.php` to customize:

- Route prefix
- Middleware
- Excluded tables
- API settings

## License

The MIT License (MIT). Please see License File for more information.