<?php

namespace Siiau\ApiClient\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Enums\Genero;
use Siiau\ApiClient\Objects\Domicilio;
use Siiau\ApiClient\Objects\Empresa;
use Siiau\ApiClient\Objects\Nacimiento;
use Siiau\ApiClient\Objects\NombreCompleto;
use Siiau\ApiClient\Objects\Usuario;

class GetUsuarioRequest extends Request implements HasBody
{
    use HasJsonBody;
    /**
     * The HTTP method.
     */
    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $codigo,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/api/datos-usuario';
    }

    protected function defaultBody(): array
    {
        return [
            'codigo' => $this->codigo,
        ];
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function createDtoFromResponse(Response $response): Usuario
    {
        $response = $response->json();
        return new Usuario(
            estadoCivil: $response['edo_civil'],
            empresa: new Empresa(
                nombre: $response['nom_empresa'],
                giro: $response['giro_empresa'],
                telefono: $response['tel_empresa'],
            ),
            domicilio: new Domicilio(
                localidad: $response['localidad'],
                calle: $response['domicilio'],
                colonia: $response['colonia'],
                noInterior: $response['no_interior'],
                noExterior: $response['no_exterior'],
            ),
            telefono: $response['telefono'],
            imss: $response['imss'],
            rfc: $response['rfc'],
            tipoSangre: $response['tipo_sangre'],
            codigo: $response['codigo'],
            nombreCompleto: new NombreCompleto(
                nombre: $response['nombre'],
                apellido: $response['ap_paterno'] . ' ' . $response['ap_materno'],
            ),
            genero: Genero::from($response['genero']),
            email: $response['email'],
            migratoria: $response['migratoria'],
            curp: $response['curp'],
            nacionalidad: $response['nacionalidad'],
            nacimiento: new Nacimiento(
                localidadNacimiento: $response['loc_nac'],
                fechaNacimiento: $response['fech_nac'],
                paisNacimiento: $response['pais_nac'],
            ),
            pidm: $response['pidm'],
        );
    }
}
