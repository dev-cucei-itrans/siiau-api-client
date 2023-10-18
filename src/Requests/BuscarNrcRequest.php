<?php

namespace Siiau\ApiClient\Requests;

use JsonException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{Request, Response};
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Objects\Error;

final class BuscarNrcRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $claveMateria,
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
            'claveMateria' => $this->claveMateria,
            'seccion' => $this->seccion,
            'ciclo' => $this->ciclo
        ];
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): string|Error|null
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

        return $data['nrc'];
    }
}
