<?php

namespace Siiau\ApiClient\Requests;

use JsonException;
use Siiau\ApiClient\Attributes\NonAuthenticable;
use Siiau\ApiClient\Objects\{Error, Token};
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\{Request, Response};
use Saloon\Traits\Body\HasJsonBody;

#[NonAuthenticable]
final class LoginRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $email,
        private readonly string $password,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/api/login';
    }

    protected function defaultBody(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): Token|Error
    {
        if ($response->failed()) {
            return new Error($response->json('error'));
        }

        return new Token(
            value: $response->json('token'),
            type: 'Bearer',
        );
    }
}
