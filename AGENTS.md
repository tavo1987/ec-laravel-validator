# AGENTS.md - AI Coding Agent Guidelines

This document provides guidelines for AI coding agents working in the `tavo1987/laravel-ec-validator` codebase.

## Project Overview

**Package:** `tavo1987/laravel-ec-validator`  
**Purpose:** Laravel validation rules for Ecuadorian identification numbers (Cédula and RUC)

**Supported Validation Rules:**
- `ecuador:ci` - Validates Cédula (Ecuadorian ID card)
- `ecuador:ruc` - Validates RUC for natural persons
- `ecuador:ruc_spub` - Validates RUC for public companies
- `ecuador:ruc_spriv` - Validates RUC for private companies

**Requirements:** PHP ^8.2, Laravel ^11.0|^12.0  
**Core Dependency:** `tavo1987/ec-validador-cedula-ruc` ^2.0

---

## Build & Development Commands

```bash
# Install dependencies
composer install

# Update dependencies
composer update

# Regenerate autoloader after adding new classes
composer dump-autoload
```

---

## Test Commands

```bash
# Run all tests
./vendor/bin/phpunit

# Run a specific test file
./vendor/bin/phpunit tests/CustomValidationRulesTest.php

# Run a single test method by name
./vendor/bin/phpunit --filter valid_ci

# Run tests matching a pattern
./vendor/bin/phpunit --filter "ruc"

# Run with verbose output
./vendor/bin/phpunit -v

# Run with human-readable output
./vendor/bin/phpunit --testdox
```

---

## Code Style Guidelines

### StyleCI Integration

This project uses **StyleCI** for external code style enforcement:
- StyleCI uses the default `recommended` preset (no `.styleci.yml` override)
- StyleCI automatically sends pull requests for code style fixes
- Do not manually fix style issues that StyleCI will handle

### Formatting

From `.editorconfig`:
- **Indentation:** 4 spaces (no tabs)
- **Line endings:** LF (Unix-style)
- **Final newline:** Always insert a final newline in all files
- **Braces:** Opening braces on the same line as the declaration

### Namespacing & Imports

- **Namespace:** `Tavo\EcLaravelValidator`
- **PSR-4 autoloading:** `src/` maps to `Tavo\EcLaravelValidator\`
- **Import grouping:** PHP core classes, then Laravel classes, then package classes
- **One class per file**

Example:
```php
<?php

namespace Tavo\EcLaravelValidator;

use Error;
use Illuminate\Validation\Validator;
use Tavo\ValidadorEc;
```

### Naming Conventions

| Element | Convention | Example |
|---------|------------|---------|
| Classes | PascalCase | `LaravelValidatorEc`, `EcValidatorServiceProvider` |
| Methods | camelCase | `validateEcuador()`, `getPackageProviders()` |
| Properties | camelCase with visibility and type | `private bool $isValid` |
| Constants | UPPER_SNAKE_CASE | `TYPE_CEDULA` |
| Test methods | snake_case with `#[Test]` attribute | `valid_ci`, `invalid_ruc_for_private_companies` |

### PHP 8.2+ Features

- Use typed properties: `private bool $isValid = false;`
- Use return types on all methods: `public function boot(): void`
- Use `#[Test]` attributes instead of `/** @test */` annotations
- Use `mixed` type hint where appropriate

### Documentation

- PHPDoc blocks for public methods
- `@return` type hints (in addition to native return types)
- `@param` annotations for method parameters
- Inline comments only for complex logic

Example:
```php
/**
 * Register custom validation rules.
 *
 * @return void
 */
public function boot(): void
{
    // ...
}
```

### Error Handling

- Use try-catch blocks for validation logic
- Throw `Error` class for invalid arguments or configuration errors
- Return boolean values for validation pass/fail results

---

## Testing Patterns

**Framework:** PHPUnit 11.x with Orchestra Testbench 9.x/10.x

### Base Test Class

Extend `Orchestra\Testbench\TestCase` for package testing:

```php
abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [EcValidatorServiceProvider::class];
    }
}
```

### Writing Tests

- Use `#[Test]` attribute above test methods (PHP 8 style)
- Add `public` visibility to all test methods
- Add `: void` return type to all test methods
- Name tests with snake_case describing expected behavior
- Access validator via `$this->app['validator']->make($data, $rules)`

Example:
```php
use PHPUnit\Framework\Attributes\Test;

#[Test]
public function valid_ci(): void
{
    $validator = $this->app['validator']->make(
        ['ci' => '0926687856'],
        ['ci' => 'ecuador:ci']
    );

    $this->assertTrue($validator->passes());
}

#[Test]
public function invalid_attribute_throws_an_error(): void
{
    $this->expectException(Error::class);
    
    $this->app['validator']->make(
        ['ci' => '0926687856'],
        ['ci' => 'ecuador:invalid']
    )->validate();
}
```

---

## Architecture Notes

- **Service Provider Pattern:** Auto-discovered by Laravel via `composer.json` extra config
- **Custom Validator:** Extends `Illuminate\Validation\Validator` with `validateEcuador()` method
- **Delegation:** Validation logic delegates to `Tavo\ValidadorEc` library methods (v2.0 English API)
- **Boot-time Registration:** Validator registered via `Validator::resolver()` in service provider

### Method Mapping (v2.0)

The Laravel validation rules map to the core library methods:

| Laravel Rule | ValidadorEc Method |
|--------------|-------------------|
| `ecuador:ci` | `validateCedula()` |
| `ecuador:ruc` | `validateNaturalPersonRuc()` |
| `ecuador:ruc_spub` | `validatePublicCompanyRuc()` |
| `ecuador:ruc_spriv` | `validatePrivateCompanyRuc()` |

---

## File Structure

```
src/
  EcValidatorServiceProvider.php  # Laravel service provider (auto-discovered)
  LaravelValidatorEc.php          # Custom validator with ecuador:* rules
tests/
  TestCase.php                    # Base test case with package providers
  CustomValidationRulesTest.php   # Validation rule tests
composer.json                     # Package definition and autoloading
phpunit.xml                       # PHPUnit 11 configuration
.editorconfig                     # Editor formatting rules
```

---

## Language

- All code and comments must be written in **English**
- Documentation files should be in **English**
