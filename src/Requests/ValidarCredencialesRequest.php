<?php

namespace Siiau\ApiClient\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{Request, Response};
use Saloon\Traits\Body\HasJsonBody;
use Siiau\ApiClient\Objects\Error;

final class ValidarCredencialesRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $codigo,
        private readonly string $password,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/api/validar-credenciales';
    }

    protected function defaultBody(): array
    {
        return [
            'codigo' => $this->codigo,
            'password' => $this->password,
        ];
    }

    public function createDtoFromResponse(Response $response): bool|Error
    {
        if ($response->serverError()) {
            return new Error($response->body());
        }

        return $response->body() === '"true"';
    }
}
