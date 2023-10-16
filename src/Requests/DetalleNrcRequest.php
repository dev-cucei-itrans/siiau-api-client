<?php

namespace Siiau\ApiClient\Requests;

use JsonException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{Request, Response};
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Enums\Dia;
use Siiau\ApiClient\Objects\{DetalleNrc, Error, Fecha, HorarioMateria, Profesor};

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
        if($response->serverError()){
            return new Error(message: $response->body());
        }

        if($response->status() === 404){
            return null;
        }
        
        $data = $response->json();
        
        if($response->failed()) {
            return new Error(message: $data->json('error'));
        }

        $horarios = array();
        $profesores = array();
        $siglasDias = ['LUN', 'MAR', 'MIE', 'JUE', 'VIE', 'SAB'];
        $dias = array();

        foreach($data['nrc'] as $horario) {
            $diasObtenidos = array_intersect_key($horario, array_flip($siglasDias));
            $diasFiltrados = array_filter($diasObtenidos, function($v){
                return trim($v);
            });
            $dias = array_map(function ($siglaDia) {
                return Dia::from($siglaDia);
            }, array_keys($diasFiltrados));
            $horarios[] = new HorarioMateria(
                hora: $horario['horario'],
                edificio: $horario['edificio'],
                aula: $horario['aula'],
                dias: $dias
            );
        };

        foreach($data['profesores'] as $profesor) {
            $profesores[] = new Profesor(
                codigo: $profesor['codigoProfesor']
            );
        };

        return new DetalleNrc(
            cupo: $data['cupo'],
            disponibilidad: $data['disp'],
            horario: $horarios,
            profesor: $profesores,
            fecha: new Fecha(
                inicio: $data['fechaInicio'],
                fin: $data['fechaFin'],
            ),
        );
    }
}
