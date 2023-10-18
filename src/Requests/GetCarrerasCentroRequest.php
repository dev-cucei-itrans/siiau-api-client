<?php

namespace Siiau\ApiClient\Requests;

use JsonException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{Request, Response};
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Objects\{Carrera, Error};

final class GetCarrerasCentroRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $siglas,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/api/carreras-centro';
    }

    protected function defaultBody(): array
    {
        return [
            'sigla' => $this->siglas,
        ];
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): array|Error|null
    {
        if($response->serverError()) {
            return new Error(message: $response->body());
        }

        if($response->status() === 404) {
            return null;
        }

        $data = $response->json();

        if($response->failed()) {
            return new Error(message: $data->json('error'));
        }

        $carreras = array();

        foreach($data as $carrera) {
            $carreras[] = new Carrera(
                id: $carrera['clave'],
                descripcion: $carrera['descripcion'],
            );
        }

        return $carreras;
    }
}
