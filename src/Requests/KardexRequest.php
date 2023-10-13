<?php

namespace Siiau\ApiClient\Requests;

use JsonException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{Request, Response};
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Objects\{Ciclo, Creditos, CreditosArea, Error, EstatusMateria, Fecha, Kardex, Materia};

final class KardexRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $codigo,
        private readonly string $carrera
    ) {}

    public function resolveEndpoint(): string
    {
        return '/api/kardex';
    }

    protected function defaultBody(): array
    {
        return [
            'codigo' => $this->codigo,
            'carrera' => $this->carrera,
        ];
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): Kardex|Error
    {
        if($response->failed()) {
            return new Error($response->json('error'));
        }

        $data = $response->json();
        $areas = array();
        $materias = array();

        foreach($data['creditosArea'] as $area) {
            $areas[] = new CreditosArea(
                creditos: new Creditos(
                    adquiridos: $area['creditosAdquiridos'],
                    requeridos: $area['creditosRequeridos'],
                ),
                diferencia: $area['diferencia'],
                area: $area['area']
            );
        }

        foreach($data['materias'] as $materia) {
            $materias[] = new Materia(
                nrc: $materia['nrc'],
                clave: $materia['clave'],
                descripcion: $materia['descripcion'],
                creditos: $materia['creditos'],
                fecha: new Fecha(
                    fechaFin: $materia['fecha'],
                ),
                estatus: new EstatusMateria(
                    calificacion: $materia['calificacion'],
                    tipo: $materia['tipo'],
                ),
                ciclo: new Ciclo(
                    id: $materia['ciclo'],
                ),
            );
        }

        return new Kardex(
            creditos: new Creditos(
                adquiridos: $data['creditosAdquiridos'],
                requeridos: $data['creditosRequeridos'],
            ),
            certificado: $data['tipoCertificado'],
            promedio: $data['promedio'],
            materias: $materias,
            creditosArea: $areas,
        );
    }
}
