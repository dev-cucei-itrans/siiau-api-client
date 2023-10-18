<?php

namespace Siiau\ApiClient\Requests;

use JsonException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{Request, Response};
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Enums\Dia;
use Siiau\ApiClient\Objects\{Error, Periodo, Horario, HorarioMateria, Materia, Profesor};

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
    public function createDtoFromResponse(Response $response): Horario|Error|null
    {
        if ($response->status() === 404) {
            return null;
        }

        if ($response->serverError()) {
            return new Error(message: $response->body());
        }

        $data = $response->json();

        $materias = [];
        $siglasDias = ['LUN', 'MAR', 'MIE', 'JUE', 'VIE', 'SAB'];

        foreach($data as $materia) {
            $horarios = array_map(function ($horario) use ($siglasDias) {
                $diasFiltrados = array_intersect_key($horario, array_flip($siglasDias));
                $dias = array_map(function ($siglaDia) {
                    return Dia::from($siglaDia);
                }, array_keys($diasFiltrados));
                return new HorarioMateria(
                    hora: $horario['hora'],
                    edificio: $horario['edificio'],
                    aula: $horario['aula'],
                    dias: $dias,
                );
            }, $materia['Horario']);

            $materias[] = new Materia(
                nrc: $materia['nrc'],
                clave: $materia['clave'],
                descripcion: $materia['descripcion'],
                creditos: $materia['creditos'],
                seccion: $materia['seccion'],
                horario: $horarios,
                periodo: new Periodo(
                    inicio: $materia['fechaInicio'],
                    fin: $materia['fechaFin'],
                ),
                profesor: new Profesor(
                    codigo: $materia['codigoProfesor'],
                    nombre: $materia['nombreProfesor'],
                ),
            );
        }

        return new Horario(
            materias: $materias,
        );
    }
}
