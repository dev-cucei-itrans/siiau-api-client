# SIIAU API Client

Simple SDK for interacting with SIIAU web service

Ejemplo:
````php
use Siiau\ApiClient\Requests\{LoginRequest, GetAlumnoRequest};
use Siiau\ApiClient\{SiiauAuthenticator, SiiauConnector};

// Conector
$siiau = new SiiauConnector(url: 'https://example.siauu.com');

// Auténtica todas las requests usando el mismo autenticador
$siiau->authenticate(new SiiauAuthenticator(new LoginRequest(
    email: 'your@email.com',
    password: 'YourSecurePassword',
)));

// Envía la petición
$response = $siiau->send(new GetAlumnoRequest(
    codigo: '316438817',
));

// Accede a datos
$response->dto()->nombre;

````
