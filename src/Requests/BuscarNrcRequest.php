<?php

namespace Siiau\ApiClient\Requests;

use JsonException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{Request, Response};
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Objects\{Carrera};

final class BuscarNrcRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $clave,
        private readonly string $seccion,
        private readonly string $ciclo
    ) {}

    public function resolveEndpoint(): string
    {
        return '/api/buscar-nrc';
    }

    protected function defaultBody(): array
    {
        return [
            'clave' => $this->clave,
            'seccion' => $this->seccion,
            'ciclo' => $this->ciclo
        ];
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        return true;
    }
}
