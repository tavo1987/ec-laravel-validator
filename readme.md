Laravel Validador de Cédula y RUC de Ecuador
=============================
[ ![Codeship Status for tavo1987/ec-laravel-validator](https://app.codeship.com/projects/5a2eb6e0-29cd-0135-4450-0a506178a12f/status?branch=master)](https://app.codeship.com/projects/223752)
<a href="https://packagist.org/packages/tavo1987/laravel-ec-validator"><img src="https://img.shields.io/badge/Packagist-v1.2.0-orange.svg?style=flat-square"></a>
<a href="https://packagist.org/packages/tavo1987/ec-validador-cedula-ruc"><img src="https://img.shields.io/github/license/mashape/apistatus.svg?style=flat-square"></a>
[![Latest Stable Version](https://poser.pugx.org/tavo1987/laravel-ec-validator/v/stable)](https://packagist.org/packages/tavo1987/laravel-ec-validator)
[![Total Downloads](https://poser.pugx.org/tavo1987/laravel-ec-validator/downloads)](https://packagist.org/packages/tavo1987/laravel-ec-validator)

Pequeño paquete para agregar reglas personalizadas a laravel, valida fácilmente:

- Cédula
- RUC de persona natural
- RUC de sociedad privada
- RUC de sociedad pública

Introducción
-------------
Este paquete tiene como dependencia [ec-validador-cedula-ruc](https://github.com/tavo1987/ec-validador-cedula-ruc) Si quieres saber más sobre la lógica utilizada en este paquete puedes visitar el siguiente artículo [Cómo validar cédula y RUC en Ecuador](https://medium.com/@bryansuarez/c%C3%B3mo-validar-c%C3%A9dula-y-ruc-en-ecuador-b62c5666186f), donde se detalla el proceso manual.

Instalación
----
```bash
composer require tavo1987/laravel-ec-validator
```
Siguiente, incluye el service provider dentro de tu archivo config/app.php.
```php
'providers' => [
    Tavo\EcLaravelValidator\EcValidatorServiceProvider::class,
];
```

Uso
----


- Luego ya podemos usar nuestra reglas personalizadas

Ejemplo:

```php
    //valida Cédula
    $this->validate($request, [
        'cedula' => 'ecuador:ci',
    ]);

    //valida Ruc persona Natural
    $this->validate($request, [
        'ruc' => 'ecuador:ruc',
    ]);

    //valida Ruc Sociedad Pública
    $this->validate($request, [
        'ruc' => 'ecuador:ruc_spub',
    ]);

    //valida Ruc Sociedad Privada
    $this->validate($request, [
        'ruc' => 'ecuador:ruc_spriv',
    ]);
```

Tests
-------

El paquete se encuentra con su respectiva suite de tests (phpunit) los cuales puedes encontrarlos
en el siguiente directorio `tests`

Cómo contribuir
------------

Si encuentras algún error o quieres agregar más funcionalidad, por favor siéntete libre de abrir un issue o enviar un pull request, que
lo analizaremos y agregaremos a nuestro repositorio lo mas pronto posible, siempre y cuando cumpla con las siguientes reglas

- Todos los Test deben estar en verde, es decir pasar exitosamente
- Si escribes una nueva funcionalidad este debe tener su propio test, para probar la misma

Contactos
------------
Edwin Ramírez
- Twitter: [@edwin_tavo](https://twitter.com/edwin_tavo)

Bryan Suárez
- Twitter: [@BryanSC_7](https://twitter.com/BryanSC_7)
