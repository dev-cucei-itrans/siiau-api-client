# SIIAU API Client
## _Simple SDK for interacting with SIIAU web service_

### Documentación adicional
[Documentación](https://dev-cucei-itrans.gitbook.io/siiau-api-client)

### Instalación
````bash
composer require dev-cucei-itrans/siiau-api-client
````
### Configuración de credenciales
Para hacer uso del paquete se tendrán que configurar las debidas credenciales dentro del archivo .env
````env
SIIAU_WS_URL="url_de_la_api"
SIIAU_WS_EMAIL="correo_de_acceso"
SIIAU_WS_PASSWORD="contraseña_de_acceso"
````

### Uso
````php
$alumno = siiau()->alumno()->encontrar(
    codigo: '1234567890'
);
````

### Cómo utilizar los DTO
El uso del helper retornará un DTO. Con esto podrá acceder a información específica de la respuesta de forma sencilla.
````php
echo($alumno->carrera->id);
````
Realizando esto, podría imprimir lo siguiente.
````bash
INNI
````
