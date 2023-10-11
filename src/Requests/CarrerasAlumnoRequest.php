<?php

namespace Siiau\ApiClient\Requests;

use JsonException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{Request, Response};
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Objects\{Carrera, CarrerasAlumno, Ciclo, Estatus, Universidad};

final class CarrerasAlumnoRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $codigo,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/api/carreras-alumno';
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
    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();
        $carreras = array();

        foreach($data as $carrera) {
            $carreras[] = new CarrerasAlumno(
                carrera: new Carrera(
                    id: $carrera['carreraId'],
                    descripcion: $carrera['carreraDesc'],
                ),
                cicloAdmision: new Ciclo(
                    id: $carrera['cicloAdmisionId'],
                    descripcion: $carrera['cicloAdmisionDesc'],
                ),
                ultimoCiclo: new Ciclo(
                    id: $carrera['idUltimoCiclo'],
                    descripcion: $carrera['descUltimoCiclo'],
                ),
                estatus: new Estatus(
                    id: $carrera['situacionId'],
                    descripcion: $carrera['situacionDesc'],
                ),
                nivel: $carrera['nivel'],
                universidad: new Universidad(
                    sede: $carrera['sede'],
                    campus: $carrera['campus'],
                )
            );
        }
        //$carreras = array_unique($carreras);
        return $carreras;
    }
}
