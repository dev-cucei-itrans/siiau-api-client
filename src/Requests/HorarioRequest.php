<?php

namespace Siiau\ApiClient\Requests;

use JsonException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{Request, Response};
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Objects\{DatosMateria, Fecha, Horario, HorarioMateria, Materia, Profesor};

final class HorarioRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $codigo,
        private readonly string $ciclo
    ) {}

    public function resolveEndpoint(): string
    {
        return '/api/horarios-alumno';
    }

    protected function defaultBody(): array
    {
        return [
            'codigo' => $this->codigo,
            'ciclo' => $this->ciclo,
        ];
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): Horario
    {
        $data = $response->json();
        $materias = array();
        $horarios = array();


        foreach($data as $materia) {
            $horarios = array_map(function ($horario) {
                return new HorarioMateria(
                    hora: $horario['hora'],
                    aula: $horario['aula'],
                    edificio: $horario['edificio'],
                );
            }, $materia['Horario']);

            $materias[] = new Materia(
                datosMateria: new DatosMateria(
                    nrc: $materia['nrc'],
                    clave: $materia['clave'],
                    seccion: $materia['seccion'],
                    descripcion: $materia['descripcion'],
                    creditos: $materia['creditos'],
                    horarioMateria: $horarios,
                ),
                fecha: new Fecha(
                    fechaInicio: $materia['fechaInicio'],
                    fechaFin: $materia['fechaFin'],
                ),
                estatus: null,
                ciclo: null,
                profesor: new Profesor(
                    nombreProfesor: $materia['nombreProfesor'],
                    codigoProfesor: $materia['codigoProfesor'],
                ),
            );
        }

        return new Horario(
            materias: $materias,
        );
    }
}
