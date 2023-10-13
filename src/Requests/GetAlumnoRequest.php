<?php

namespace Siiau\ApiClient\Requests;

use JsonException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{Request, Response};
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Objects\{Alumno, Carrera, Ciclo, Error, Estatus, Nombre, Universidad};

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
    public function createDtoFromResponse(Response $response): Alumno|Error
    {
        if($response->failed()) {
            return new Error($response->json('error'));
        }

        $data = $response->json();

        return new Alumno(
            carrera: new Carrera(id: $data['carrera']),
            nombre: new Nombre(nombres: $data['nombre'], apellidos: $data['apellido']),
            codigo: $data['codigo'],
            estatus: new Estatus(id: $data['situacion']),
            ultimoCiclo: new Ciclo(id: $data['ultimo_ciclo'], descripcion: $data['ultimo_cicloDesc']),
            campus: new Universidad(campus: $data['campus'])
        );
    }
}
