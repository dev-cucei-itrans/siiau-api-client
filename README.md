# SIIAU API Client

[![Latest Stable Version](http://poser.pugx.org/dev-cucei-itrans/siiau-api-client/v)](https://packagist.org/packages/dev-cucei-itrans/siiau-api-client)
[![Total Downloads](http://poser.pugx.org/dev-cucei-itrans/siiau-api-client/downloads)](https://packagist.org/packages/dev-cucei-itrans/siiau-api-client)
[![License](http://poser.pugx.org/dev-cucei-itrans/siiau-api-client/license)](https://packagist.org/packages/dev-cucei-itrans/siiau-api-client)
[![PHP Version Require](http://poser.pugx.org/dev-cucei-itrans/siiau-api-client/require/php)](https://packagist.org/packages/dev-cucei-itrans/siiau-api-client)

Un SDK para proyectos de Laravel que facilita interactuar con la API interna de SIIAU de la Universidad de Guadalajara.

## Instalación

Para descargar e instalar el paquete, puedes hacer uso de [Composer](https://getcomposer.org/) en tu proyecto y ejecutar
el comando:

````bash
composer require dev-cucei-itrans/siiau-api-client
````

## Configuración

Agrega las siguientes variables de entorno a tu proyecto con las credenciales de acceso correspondientes.

````env
SIIAU_WS_URL="https://example.siiau.com"
SIIAU_WS_EMAIL="your@email.com"
SIIAU_WS_PASSWORD="YourSecurePassword"
````

### Uso

Para interactuar con la API, se puede hacer uso del helper `siiau()`. Este helper permite acceder a los métodos de forma
sencilla.

````php
$alumno = siiau()->alumno()->encontrar(
    codigo: '123456789',
);
````

Para más información sobre los métodos disponibles y caracteristicas del SDK, puedes revisar la [documentación](https://dev-cucei-itrans.gitbook.io/siiau-api-client).

## Contribución

Cualquier sugerencia, problema o duda generar un nuevo issue si es que no existe uno que lo describa ya.
