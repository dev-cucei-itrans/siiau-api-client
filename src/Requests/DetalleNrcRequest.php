<?php

namespace Siiau\ApiClient\Requests;

use JsonException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{Request, Response};
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Collections\{DiaCollection, HorarioCollection, ProfesorCollection};
use Siiau\ApiClient\Enums\Dia;
use Siiau\ApiClient\Objects\{DetalleNrc, Error, Periodo, HorarioMateria, Profesor};

final class DetalleNrcRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $nrc,
        private readonly string $ciclo
    ) {}

    public function resolveEndpoint(): string
    {
        return '/api/detalle-nrc';
    }

    protected function defaultBody(): array
    {
        return [
            'nrc' => $this->nrc,
            'ciclo' => $this->ciclo
        ];
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): DetalleNrc|Error|null
    {
        if ($response->status() === 404) {
            return null;
        }

        if ($response->failed()) {
            return new Error(message: $response->body());
        }

        $data = $response->json();

        $horarios = new HorarioCollection();
        $profesores = new ProfesorCollection();
        $siglasDias = ['LUN', 'MAR', 'MIE', 'JUE', 'VIE', 'SAB'];

        foreach($data['nrc'] as $horario) {
            $diasObtenidos = array_intersect_key($horario, array_flip($siglasDias));
            $diasFiltrados = array_filter($diasObtenidos, function ($v) {
                return trim($v);
            });
            $dias = array_map(function ($siglaDia) {
                return Dia::from($siglaDia);
            }, array_keys($diasFiltrados));
            $diasCollection = array_reduce($dias, function ($collection, $horario) {
                $collection->add($horario);
                return $collection;
            }, new DiaCollection());
            $horarios[] = new HorarioMateria(
                hora: $horario['horario'],
                edificio: $horario['edificio'],
                aula: $horario['aula'],
                dias: $diasCollection
            );
        }

        foreach($data['profesores'] as $profesor) {
            $profesores[] = new Profesor(
                codigo: $profesor['codigoProfesor']
            );
        }

        return new DetalleNrc(
            cupo: $data['cupo'],
            disponibilidad: $data['disp'],
            horario: $horarios,
            profesor: $profesores,
            periodo: new Periodo(
                inicio: $data['fechaInicio'],
                fin: $data['fechaFin'],
            ),
        );
    }
}
