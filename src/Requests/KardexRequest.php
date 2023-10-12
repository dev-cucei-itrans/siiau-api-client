<?php

namespace Siiau\ApiClient\Requests;

use JsonException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{Request, Response};
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Objects\{Ciclo, Creditos, CreditosArea, DatosMateria, EstatusMateria, Fecha, Kardex, Materia};

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
    public function createDtoFromResponse(Response $response): Kardex
    {
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
                datosMateria: new DatosMateria(
                    nrc: $materia['nrc'],
                    clave: $materia['clave'],
                    seccion: null,
                    descripcion: $materia['descripcion'],
                    creditos: $materia['creditos'],
                    horarioMateria: null,
                ),
                fecha: new Fecha(
                    fechaInicio: $materia['fecha'],
                    fechaFin: null,
                ),
                estatus: new EstatusMateria(
                    calificacion: $materia['calificacion'],
                    tipo: $materia['tipo'],
                ),
                ciclo: new Ciclo(
                    id: $materia['ciclo'],
                    descripcion: null,
                ),
                profesor: null,
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
