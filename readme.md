# Laravel Ecuador Validator

[![Latest Stable Version](https://poser.pugx.org/tavo1987/laravel-ec-validator/v/stable)](https://packagist.org/packages/tavo1987/laravel-ec-validator)
[![Total Downloads](https://poser.pugx.org/tavo1987/laravel-ec-validator/downloads)](https://packagist.org/packages/tavo1987/laravel-ec-validator)
[![License](https://img.shields.io/github/license/mashape/apistatus.svg?style=flat-square)](https://packagist.org/packages/tavo1987/laravel-ec-validator)

Laravel validation rules for Ecuadorian identification numbers. Easily validate:

- **Cédula** (Ecuadorian ID card)
- **RUC** for natural persons
- **RUC** for private companies
- **RUC** for public companies

## Requirements

- PHP 8.2 or higher
- Laravel 11.x or 12.x

## Introduction

This package depends on [ec-validador-cedula-ruc](https://github.com/tavo1987/ec-validador-cedula-ruc). If you want to learn more about the validation logic, you can read the article [How to validate Cédula and RUC in Ecuador](https://medium.com/@bryansuarez/c%C3%B3mo-validar-c%C3%A9dula-y-ruc-en-ecuador-b62c5666186f) (Spanish), which details the manual process.

## Installation

```bash
composer require tavo1987/laravel-ec-validator
```

The service provider is auto-discovered by Laravel. No manual registration required.

### Manual Registration (Optional)

If you have disabled auto-discovery, add the service provider to your `config/app.php`:

```php
'providers' => [
    Tavo\EcLaravelValidator\EcValidatorServiceProvider::class,
];
```

## Usage

Use the custom validation rules in your validation logic:

```php
// Validate Cédula (ID card)
$this->validate($request, [
    'cedula' => 'ecuador:ci',
]);

// Validate RUC for natural person
$this->validate($request, [
    'ruc' => 'ecuador:ruc',
]);

// Validate RUC for public company
$this->validate($request, [
    'ruc' => 'ecuador:ruc_spub',
]);

// Validate RUC for private company
$this->validate($request, [
    'ruc' => 'ecuador:ruc_spriv',
]);
```

### Available Rules

| Rule | Description |
|------|-------------|
| `ecuador:ci` | Validates Ecuadorian Cédula (10 digits) |
| `ecuador:ruc` | Validates RUC for natural persons (13 digits) |
| `ecuador:ruc_spub` | Validates RUC for public companies (13 digits) |
| `ecuador:ruc_spriv` | Validates RUC for private companies (13 digits) |

### Using with Form Requests

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'cedula' => ['required', 'ecuador:ci'],
            'ruc' => ['nullable', 'ecuador:ruc'],
        ];
    }
}
```

## What's New in v3.0.0

### Breaking Changes

- **PHP 8.2+ required** (dropped PHP 7.x support)
- **Laravel 11/12 only** (dropped Laravel 7.x-10.x support)
- Internal method names updated to English API (transparent to users)

### Version Requirements

| Requirement | v1.x/v2.x | v3.0 |
|-------------|-----------|------|
| PHP | ^7.2.5 | ^8.2 |
| Laravel | ^7.4.0 | ^11.0 \| ^12.0 |

### New Features

- PHP 8.2+ typed properties and return types
- PHPUnit 11 with `#[Test]` attributes
- GitHub Actions CI for PHP 8.2, 8.3, 8.4
- Updated to `ec-validador-cedula-ruc` v2.0 with English API

### Upgrading from v2.x

Update your composer.json:

```bash
composer require tavo1987/laravel-ec-validator:^3.0
```

The validation rules (`ecuador:ci`, `ecuador:ruc`, etc.) remain unchanged.

## Tests

The package includes a PHPUnit test suite:

```bash
./vendor/bin/phpunit
```

## Contributing

If you find a bug or want to add functionality, please feel free to open an issue or submit a pull request. Contributions must follow these rules:

- All tests must pass
- New functionality must include tests

## Authors

**Edwin Ramírez**
- Twitter: [@edwin_tavo](https://twitter.com/edwin_tavo)

**Bryan Suárez**
- Twitter: [@BryanSC_7](https://twitter.com/BryanSC_7)

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).
