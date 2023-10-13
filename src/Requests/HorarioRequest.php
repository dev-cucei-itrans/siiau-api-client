<?php

namespace Siiau\ApiClient\Requests;

use JsonException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{Request, Response};
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Objects\{Error, Fecha, Horario, HorarioMateria, Materia, Profesor};

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
    public function createDtoFromResponse(Response $response): Horario|Error
    {
        if($response->failed()) {
            return new Error($response->json('error'));
        }

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
                nrc: $materia['nrc'],
                clave: $materia['clave'],
                seccion: $materia['seccion'],
                descripcion: $materia['descripcion'],
                creditos: $materia['creditos'],
                horario: $horarios,
                fecha: new Fecha(
                    inicio: $materia['fechaInicio'],
                    fin: $materia['fechaFin'],
                ),
                profesor: new Profesor(
                    nombre: $materia['nombreProfesor'],
                    codigo: $materia['codigoProfesor'],
                ),
            );
        }

        return new Horario(
            materias: $materias,
        );
    }
}
