# CLAUDE.md - Claude AI Guidelines

This file provides guidance to Claude AI when working in this repository.

## Language

- Always use **English** for code and comments
- Documentation files should be in **English**

## Quick Reference

See [AGENTS.md](AGENTS.md) for comprehensive guidelines.

### Common Commands

```bash
# Install dependencies
composer install

# Run all tests
./vendor/bin/phpunit

# Run single test
./vendor/bin/phpunit --filter valid_ci

# Run tests with readable output
./vendor/bin/phpunit --testdox
```

## Key Information

- **PHP Version:** ^8.2
- **Laravel Version:** ^11.0 | ^12.0
- **PHPUnit Version:** ^11.0
- **Core Library:** `tavo1987/ec-validador-cedula-ruc` ^2.0

## Code Patterns

### Validation Method Mapping

```php
private array $types = [
    'ci'        => 'validateCedula',
    'ruc'       => 'validateNaturalPersonRuc',
    'ruc_spub'  => 'validatePublicCompanyRuc',
    'ruc_spriv' => 'validatePrivateCompanyRuc',
];
```

### Test Pattern

```php
use PHPUnit\Framework\Attributes\Test;

#[Test]
public function valid_ci(): void
{
    $v = $this->app['validator']->make(
        ['ci' => '0926687856'],
        ['ci' => 'ecuador:ci']
    );
    $this->assertTrue($v->passes());
}
```

## Guidelines

1. **Always run tests** after making changes: `./vendor/bin/phpunit`
2. **Use PHP 8.2+ features:** typed properties, return types, attributes
3. **Follow PSR-4** autoloading conventions
4. **StyleCI** handles code formatting - do not manually fix style issues
