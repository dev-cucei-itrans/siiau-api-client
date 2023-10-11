<?php

namespace Siiau\ApiClient\Requests;

use JsonException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{Request, Response};
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Objects\{Alumno, Ciclo, Nombre};

final class GetAlumnoRequest extends Request implements HasBody
{
    use HasJsonBody;

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

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): Alumno
    {
        $data = $response->json();

        return new Alumno(
            carrera: $data['carrera'],
            nombre: new Nombre($data['nombre'], $data['apellido']),
            codigo: $data['codigo'],
            situacion: $data['situacion'],
            ultimoCiclo: new Ciclo($data['ultimo_ciclo'], $data['ultimo_cicloDesc']),
            campus: $data['campus']
        );
    }
}
