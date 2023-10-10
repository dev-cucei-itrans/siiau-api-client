<?php

namespace Siiau\ApiClient\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Objects\Alumno;
use Siiau\ApiClient\Objects\Ciclo;
use Siiau\ApiClient\Objects\NombreCompleto;

class GetAlumnoRequest extends Request implements HasBody
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
        return '/api/datos-alumno';
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

    public function createDtoFromResponse(Response $response): Alumno
    {
        $response = $response->json();
        return new Alumno(
            nombre: new NombreCompleto($response['nombre'], $response['apellido']),
            carrera: $response['carrera'],
            codigo: $response['codigo'],
            situacion: $response['situacion'],
            ultimoCiclo: new Ciclo($response['ultimo_ciclo'], $response['ultimo_cicloDesc']),
            campus: $response['campus']
        );
    }
}
